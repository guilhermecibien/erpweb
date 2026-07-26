<?php

namespace Tests\Feature\Sales;

use App\Models\Contact;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VariationLocationDetails;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\Concerns\CreatesStockedProduct;
use Tests\TestCase;

class SellPosControllerTest extends TestCase
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
            'admin_sell_pos',
            'no_perm_sell_pos',
            'no_delete_sell_pos',
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

    /**
     * Full payment-line payload as expected by TransactionUtil::createOrUpdatePaymentLines(),
     * which reads every one of these keys directly (no isset()) - matches
     * SellPosController::$dummyPaymentLine.
     */
    private function cashPaymentPayload(string $amount): array
    {
        return [
            'method' => 'cash',
            'amount' => $amount,
            'note' => '',
            'card_transaction_number' => '',
            'card_number' => '',
            'card_type' => '',
            'card_holder_name' => '',
            'card_month' => '',
            'card_year' => '',
            'card_security' => '',
            'cheque_number' => '',
            'bank_account_number' => '',
            'is_return' => 0,
            'transaction_no' => '',
            'data_base' => now()->format('d/m/Y'),
            'intervalo' => '',
            'vencimento' => now()->format('d/m/Y'),
            'qtd_parcelas' => 1,
        ];
    }

    public function test_pos_index_requires_sell_permission()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_sell_pos',
            'password' => 'secret123',
        ]);

        $viewer = $this->createNoPermUser($business, 'no_perm_sell_pos');

        $this->actingAs($viewer)
            ->get('/pos')
            ->assertForbidden();

        $this->actingAs($admin)
            ->get('/pos')
            ->assertOk();
    }

    public function test_admin_can_create_a_direct_sale_and_it_decreases_stock()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_sell_pos',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();
        [$product, $variation] = $this->createStockedProduct($business, $admin, $location, 20);
        $customer = Contact::where('business_id', $business->id)->where('is_default', 1)->firstOrFail();

        $payload = [
            'is_direct_sale' => 1,
            'status' => 'final',
            'location_id' => $location->id,
            'contact_id' => $customer->id,
            'transaction_date' => now()->format('d/m/Y H:i'),
            'discount_type' => 'fixed',
            'discount_amount' => '0',
            'tax_rate_id' => '',
            'final_total' => '30',
            'valor_recebido' => '30',
            'change_return' => '0',
            'products' => [
                [
                    'product_id' => $product->id,
                    'variation_id' => $variation->id,
                    'quantity' => '3',
                    'unit_price' => '10',
                    'unit_price_inc_tax' => '10',
                    'item_tax' => '0',
                    'tax_id' => null,
                    'enable_stock' => 1,
                    'product_type' => 'single',
                ],
            ],
            'payment' => [
                $this->cashPaymentPayload('30'),
            ],
        ];

        $this->actingAs($admin)
            ->post('/pos', $payload)
            ->assertRedirect(action('SellController@index'));

        $this->assertDatabaseHas('transactions', [
            'business_id' => $business->id,
            'type' => 'sell',
            'status' => 'final',
            'location_id' => $location->id,
            'contact_id' => $customer->id,
        ]);

        $sale = Transaction::where('business_id', $business->id)->where('type', 'sell')->firstOrFail();
        $this->assertEquals(1, $sale->sell_lines()->count());

        $remaining = VariationLocationDetails::where('variation_id', $variation->id)
            ->where('location_id', $location->id)
            ->value('qty_available');
        $this->assertEquals(17, (float) $remaining);
    }

    public function test_user_without_sell_permission_cannot_create_a_sale()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_sell_pos',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();
        [$product, $variation] = $this->createStockedProduct($business, $admin, $location, 20);
        $customer = Contact::where('business_id', $business->id)->where('is_default', 1)->firstOrFail();
        $viewer = $this->createNoPermUser($business, 'no_perm_sell_pos');

        $payload = [
            'is_direct_sale' => 1,
            'status' => 'final',
            'location_id' => $location->id,
            'contact_id' => $customer->id,
            'transaction_date' => now()->format('d/m/Y H:i'),
            'discount_type' => 'fixed',
            'discount_amount' => '0',
            'tax_rate_id' => '',
            'final_total' => '10',
            'valor_recebido' => '10',
            'change_return' => '0',
            'products' => [[
                'product_id' => $product->id,
                'variation_id' => $variation->id,
                'quantity' => '1',
                'unit_price' => '10',
                'unit_price_inc_tax' => '10',
                'item_tax' => '0',
                'tax_id' => null,
                'enable_stock' => 1,
                'product_type' => 'single',
            ]],
            'payment' => [$this->cashPaymentPayload('10')],
        ];

        $this->actingAs($viewer)
            ->post('/pos', $payload)
            ->assertForbidden();

        $this->assertDatabaseMissing('transactions', [
            'business_id' => $business->id,
            'type' => 'sell',
        ]);
    }

    public function test_admin_can_apply_a_percentage_discount_on_sale_total()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_sell_pos',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();
        [$product, $variation] = $this->createStockedProduct($business, $admin, $location, 20);
        $customer = Contact::where('business_id', $business->id)->where('is_default', 1)->firstOrFail();

        // 2 units at 10 = 20 before discount, 10% discount -> final_total 18.
        $payload = [
            'is_direct_sale' => 1,
            'status' => 'final',
            'location_id' => $location->id,
            'contact_id' => $customer->id,
            'transaction_date' => now()->format('d/m/Y H:i'),
            'discount_type' => 'percentage',
            'discount_amount' => '10',
            'tax_rate_id' => '',
            'final_total' => '18',
            'valor_recebido' => '18',
            'change_return' => '0',
            'products' => [[
                'product_id' => $product->id,
                'variation_id' => $variation->id,
                'quantity' => '2',
                'unit_price' => '10',
                'unit_price_inc_tax' => '10',
                'item_tax' => '0',
                'tax_id' => null,
                'enable_stock' => 1,
                'product_type' => 'single',
            ]],
            'payment' => [$this->cashPaymentPayload('18')],
        ];

        $this->actingAs($admin)
            ->post('/pos', $payload)
            ->assertRedirect(action('SellController@index'));

        $sale = Transaction::where('business_id', $business->id)->where('type', 'sell')->firstOrFail();
        $this->assertEquals('percentage', $sale->discount_type);
        $this->assertEquals(20, (float) $sale->total_before_tax);
        $this->assertEquals(10, (float) $sale->discount_amount);
        $this->assertEquals(18, (float) $sale->final_total);
    }

    public function test_user_without_delete_permission_cannot_cancel_a_sale()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_sell_pos',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();
        [$product, $variation] = $this->createStockedProduct($business, $admin, $location, 20);
        $customer = Contact::where('business_id', $business->id)->where('is_default', 1)->firstOrFail();

        $this->actingAs($admin)->post('/pos', [
            'is_direct_sale' => 1,
            'status' => 'final',
            'location_id' => $location->id,
            'contact_id' => $customer->id,
            'transaction_date' => now()->format('d/m/Y H:i'),
            'discount_type' => 'fixed',
            'discount_amount' => '0',
            'tax_rate_id' => '',
            'final_total' => '10',
            'valor_recebido' => '10',
            'change_return' => '0',
            'products' => [[
                'product_id' => $product->id,
                'variation_id' => $variation->id,
                'quantity' => '1',
                'unit_price' => '10',
                'unit_price_inc_tax' => '10',
                'item_tax' => '0',
                'tax_id' => null,
                'enable_stock' => 1,
                'product_type' => 'single',
            ]],
            'payment' => [$this->cashPaymentPayload('10')],
        ]);

        $sale = Transaction::where('business_id', $business->id)->where('type', 'sell')->firstOrFail();
        $viewer = $this->createNoPermUser($business, 'no_delete_sell_pos');

        $this->actingAs($viewer)
            ->delete('/pos/' . $sale->id, [], ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertForbidden();

        $this->assertDatabaseHas('transactions', ['id' => $sale->id]);
    }

    public function test_admin_can_cancel_a_sale_and_it_restores_stock()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_sell_pos',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();
        [$product, $variation] = $this->createStockedProduct($business, $admin, $location, 20);
        $customer = Contact::where('business_id', $business->id)->where('is_default', 1)->firstOrFail();

        $this->actingAs($admin)->post('/pos', [
            'is_direct_sale' => 1,
            'status' => 'final',
            'location_id' => $location->id,
            'contact_id' => $customer->id,
            'transaction_date' => now()->format('d/m/Y H:i'),
            'discount_type' => 'fixed',
            'discount_amount' => '0',
            'tax_rate_id' => '',
            'final_total' => '20',
            'valor_recebido' => '20',
            'change_return' => '0',
            'products' => [[
                'product_id' => $product->id,
                'variation_id' => $variation->id,
                'quantity' => '2',
                'unit_price' => '10',
                'unit_price_inc_tax' => '10',
                'item_tax' => '0',
                'tax_id' => null,
                'enable_stock' => 1,
                'product_type' => 'single',
            ]],
            'payment' => [$this->cashPaymentPayload('20')],
        ]);

        $sale = Transaction::where('business_id', $business->id)->where('type', 'sell')->firstOrFail();

        $response = $this->actingAs($admin)
            ->delete('/pos/' . $sale->id, [], ['X-Requested-With' => 'XMLHttpRequest']);

        $response->assertOk();
        $response->assertJson(['success' => true]);

        $this->assertDatabaseMissing('transactions', ['id' => $sale->id]);

        $remaining = VariationLocationDetails::where('variation_id', $variation->id)
            ->where('location_id', $location->id)
            ->value('qty_available');
        $this->assertEquals(20, (float) $remaining);
    }
}
