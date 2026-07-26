<?php

namespace Tests\Feature\Cashier;

use App\Models\CashRegister;
use App\Models\City;
use App\Models\Contact;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\Concerns\CreatesStockedProduct;
use Tests\TestCase;

class CashRegisterControllerTest extends TestCase
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
            'admin_cash_register',
        ])]);
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

    public function test_pos_create_screen_requires_an_open_cash_register()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_cash_register',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $this->actingAs($admin)
            ->get('/pos/create')
            ->assertRedirect(action('CashRegisterController@create', ['sub_type' => null]));
    }

    public function test_admin_can_open_a_cash_register_with_an_initial_amount()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_cash_register',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();

        $this->actingAs($admin)
            ->post('/cash-register', [
                'location_id' => $location->id,
                'amount' => '100',
            ])
            ->assertRedirect(action('SellPosController@create', ['sub_type' => null]));

        $this->assertDatabaseHas('cash_registers', [
            'business_id' => $business->id,
            'user_id' => $admin->id,
            'location_id' => $location->id,
            'status' => 'open',
        ]);

        $register = CashRegister::where('business_id', $business->id)->where('user_id', $admin->id)->firstOrFail();

        $this->assertDatabaseHas('cash_register_transactions', [
            'cash_register_id' => $register->id,
            'amount' => 100,
            'pay_method' => 'cash',
            'type' => 'credit',
            'transaction_type' => 'initial',
        ]);
    }

    public function test_pos_create_screen_is_accessible_once_a_register_is_open()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_cash_register',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();

        $this->actingAs($admin)->post('/cash-register', [
            'location_id' => $location->id,
            'amount' => '0',
        ]);

        // isMobile() reads the raw $_SERVER['HTTP_USER_AGENT'] superglobal
        // without a fallback; the in-process test client never populates it.
        $_SERVER['HTTP_USER_AGENT'] = 'phpunit';

        $this->actingAs($admin)
            ->get('/pos/create')
            ->assertOk();
    }

    public function test_admin_can_close_an_open_cash_register()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_cash_register',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();

        $this->actingAs($admin)->post('/cash-register', [
            'location_id' => $location->id,
            'amount' => '50',
        ]);

        $this->actingAs($admin)
            ->post('/cash-register/close-register', [
                'closing_amount' => '150',
                'total_card_slips' => '2',
                'total_cheques' => '0',
                'closing_note' => 'Fechamento de teste',
            ])
            ->assertRedirect(action('HomeController@index'));

        $this->assertDatabaseHas('cash_registers', [
            'business_id' => $business->id,
            'user_id' => $admin->id,
            'status' => 'close',
            'closing_amount' => 150,
            'total_card_slips' => 2,
            'closing_note' => 'Fechamento de teste',
        ]);

        // Once closed, the register no longer counts as open for the POS gate.
        $this->actingAs($admin)
            ->get('/pos/create')
            ->assertRedirect(action('CashRegisterController@create', ['sub_type' => null]));
    }

    public function test_non_direct_sale_is_blocked_without_an_open_cash_register()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_cash_register',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();
        [$product, $variation] = $this->createStockedProduct($business, $admin, $location, 20);
        $customer = Contact::where('business_id', $business->id)->where('is_default', 1)->firstOrFail();

        $this->actingAs($admin)
            ->post('/pos', [
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
            ])
            ->assertRedirect(action('CashRegisterController@create'));

        $this->assertDatabaseMissing('transactions', [
            'business_id' => $business->id,
            'type' => 'sell',
        ]);
    }

    public function test_non_direct_sale_payment_is_recorded_against_the_open_cash_register()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_cash_register',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();
        [$product, $variation] = $this->createStockedProduct($business, $admin, $location, 20);
        $customer = Contact::where('business_id', $business->id)->where('is_default', 1)->firstOrFail();

        // Non-direct sales print a receipt, which reads $business->cidade->nome -
        // needs a real City row since Business::cidade() is a belongsTo.
        $city = City::create(['codigo' => '1', 'nome' => 'Curitiba', 'uf' => 'PR']);
        $business->cidade_id = $city->id;
        $business->save();

        $this->actingAs($admin)->post('/cash-register', [
            'location_id' => $location->id,
            'amount' => '0',
        ]);

        $response = $this->actingAs($admin)
            ->post('/pos', [
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

        // Non-direct sales (unlike direct ones) don't redirect - the
        // controller returns the JSON $output straight from store().
        $response->assertOk();
        $response->assertJson(['success' => 1]);

        $sale = Transaction::where('business_id', $business->id)->where('type', 'sell')->firstOrFail();

        $register = CashRegister::where('business_id', $business->id)
            ->where('user_id', $admin->id)
            ->where('status', 'open')
            ->firstOrFail();

        $this->assertDatabaseHas('cash_register_transactions', [
            'cash_register_id' => $register->id,
            'transaction_type' => 'sell',
            'transaction_id' => $sale->id,
            'pay_method' => 'cash',
            'amount' => 20,
        ]);
    }
}
