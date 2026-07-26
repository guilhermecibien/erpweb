<?php

namespace Tests\Feature\Stock;

use App\Models\User;
use App\Models\VariationLocationDetails;
use App\Utils\BusinessUtil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\Concerns\CreatesStockedProduct;
use Tests\TestCase;

class StockAdjustmentAndTransferTest extends TestCase
{
    use RefreshDatabase;
    use CreatesBusiness;
    use CreatesStockedProduct;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();

        // CheckPayment middleware redirects businesses without an active
        // subscription to /payment. Bypass it the same way production does
        // for administrator accounts, since subscriptions are out of scope
        // for these controller tests.
        config(['constants.administrator_usernames' => implode(',', [
            'admin_stock_adj',
            'no_perm_stock_adj',
            'no_delete_stock_adj',
            'admin_stock_transfer',
            'admin_opening_stock',
            'no_perm_opening_stock',
        ])]);
    }

    private function createNoPermUser($business, $username)
    {
        $user = User::create_user([
            'surname' => '',
            'first_name' => 'Sem',
            'last_name' => 'Permissao',
            'username' => $username,
            'email' => $username . '@example.com',
            'password' => 'secret123',
            'language' => 'pt',
        ]);
        $user->business_id = $business->id;
        $user->save();

        return $user->fresh();
    }

    public function test_stock_adjustment_index_requires_purchase_permission()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_stock_adj',
            'password' => 'secret123',
        ]);

        $viewer = $this->createNoPermUser($business, 'no_perm_stock_adj');

        $this->actingAs($viewer)
            ->get('/stock-adjustments')
            ->assertForbidden();

        $this->actingAs($admin)
            ->get('/stock-adjustments')
            ->assertOk();
    }

    public function test_admin_can_create_stock_adjustment_and_it_decreases_quantity()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_stock_adj',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();
        [$product, $variation] = $this->createStockedProduct($business, $admin, $location, 50);

        $payload = [
            'location_id' => $location->id,
            'transaction_date' => now()->format('d/m/Y H:i'),
            'adjustment_type' => 'normal',
            'total_amount_recovered' => '0',
            'products' => [
                [
                    'product_id' => $product->id,
                    'variation_id' => $variation->id,
                    'quantity' => '5',
                    'unit_price' => '10',
                ],
            ],
        ];

        $this->actingAs($admin)
            ->post('/stock-adjustments', $payload)
            ->assertRedirect('stock-adjustments');

        $this->assertDatabaseHas('transactions', [
            'business_id' => $business->id,
            'type' => 'stock_adjustment',
            'location_id' => $location->id,
        ]);

        $remaining = VariationLocationDetails::where('variation_id', $variation->id)
            ->where('location_id', $location->id)
            ->value('qty_available');

        $this->assertEquals(45, (float) $remaining);
    }

    public function test_user_without_delete_permission_cannot_destroy_stock_adjustment()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_stock_adj',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();
        [$product, $variation] = $this->createStockedProduct($business, $admin, $location, 50);

        $this->actingAs($admin)->post('/stock-adjustments', [
            'location_id' => $location->id,
            'transaction_date' => now()->format('d/m/Y H:i'),
            'adjustment_type' => 'normal',
            'total_amount_recovered' => '0',
            'products' => [[
                'product_id' => $product->id,
                'variation_id' => $variation->id,
                'quantity' => '5',
                'unit_price' => '10',
            ]],
        ]);

        $transaction = \App\Models\Transaction::where('business_id', $business->id)
            ->where('type', 'stock_adjustment')
            ->firstOrFail();

        $viewer = $this->createNoPermUser($business, 'no_delete_stock_adj');

        $this->actingAs($viewer)
            ->delete('/stock-adjustments/' . $transaction->id, [], ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertForbidden();

        $this->assertDatabaseHas('transactions', ['id' => $transaction->id]);
    }

    public function test_stock_transfer_moves_quantity_between_locations()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_stock_transfer',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $businessUtil = app(BusinessUtil::class);
        $locationFrom = $business->locations()->first();
        $locationTo = $businessUtil->addLocation($business->id, [
            'name' => 'Filial',
            'landmark' => 'Rua Dois, 2',
            'city' => 'Campinas',
            'state' => 'SP',
            'zip_code' => '13000-000',
            'country' => 'Brasil',
        ]);

        [$product, $variation] = $this->createStockedProduct($business, $admin, $locationFrom, 30);
        $product->product_locations()->sync([$locationFrom->id, $locationTo->id]);

        $payload = [
            'location_id' => $locationFrom->id,
            'transfer_location_id' => $locationTo->id,
            'transaction_date' => now()->format('d/m/Y H:i'),
            'final_total' => '100',
            'shipping_charges' => '0',
            'products' => [
                [
                    'product_id' => $product->id,
                    'variation_id' => $variation->id,
                    'quantity' => '10',
                    'unit_price' => '10',
                    'enable_stock' => 1,
                ],
            ],
        ];

        $this->actingAs($admin)
            ->post('/stock-transfers', $payload)
            ->assertRedirect('stock-transfers');

        $this->assertDatabaseHas('transactions', [
            'business_id' => $business->id,
            'type' => 'sell_transfer',
            'location_id' => $locationFrom->id,
        ]);
        $this->assertDatabaseHas('transactions', [
            'business_id' => $business->id,
            'type' => 'purchase_transfer',
            'location_id' => $locationTo->id,
        ]);

        $qtyFrom = VariationLocationDetails::where('variation_id', $variation->id)
            ->where('location_id', $locationFrom->id)
            ->value('qty_available');
        $qtyTo = VariationLocationDetails::where('variation_id', $variation->id)
            ->where('location_id', $locationTo->id)
            ->value('qty_available');

        $this->assertEquals(20, (float) $qtyFrom);
        $this->assertEquals(10, (float) $qtyTo);
    }

    public function test_opening_stock_requires_permission()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_opening_stock',
            'password' => 'secret123',
        ]);

        $location = $business->locations()->first();
        [$product] = $this->createStockedProduct($business, $admin, $location, 0);

        $viewer = $this->createNoPermUser($business, 'no_perm_opening_stock');

        $this->actingAs($viewer)
            ->get('/opening-stock/add/' . $product->id)
            ->assertForbidden();
    }

    public function test_admin_can_save_opening_stock_for_a_product()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_opening_stock',
            'password' => 'secret123',
        ]);

        $location = $business->locations()->first();
        [$product, $variation] = $this->createStockedProduct($business, $admin, $location, 0);

        $payload = [
            'product_id' => $product->id,
            'stocks' => [
                $location->id => [
                    $variation->id => [
                        [
                            'quantity' => '25',
                            'purchase_price' => '8',
                        ],
                    ],
                ],
            ],
        ];

        $this->actingAs($admin)
            ->post('/opening-stock/save', $payload)
            ->assertRedirect('products');

        $qty = VariationLocationDetails::where('variation_id', $variation->id)
            ->where('location_id', $location->id)
            ->value('qty_available');

        $this->assertEquals(25, (float) $qty);

        $this->assertDatabaseHas('transactions', [
            'business_id' => $business->id,
            'type' => 'opening_stock',
            'opening_stock_product_id' => $product->id,
            'location_id' => $location->id,
        ]);
    }
}
