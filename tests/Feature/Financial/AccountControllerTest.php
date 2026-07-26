<?php

namespace Tests\Feature\Financial;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    use RefreshDatabase;
    use CreatesBusiness;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();

        // CheckPayment middleware redirects businesses without an active
        // subscription to /payment. Bypass it the same way production does
        // for administrator accounts, since subscriptions are out of scope
        // for these controller tests. AccountController itself never checks
        // ModuleUtil::isSubscribed(), unlike ExpenseController.
        config(['constants.administrator_usernames' => implode(',', [
            'admin_account',
            'no_perm_account',
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

    public function test_no_perm_user_cannot_access_account_index()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_account',
            'password' => 'secret123',
        ]);
        $viewer = $this->createNoPermUser($business, 'no_perm_account');

        $this->actingAs($viewer)
            ->get('/account/account')
            ->assertForbidden();

        $this->actingAs($admin)
            ->get('/account/account')
            ->assertOk();
    }

    public function test_admin_can_create_an_account_with_opening_balance()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_account',
            'password' => 'secret123',
        ]);

        $this->actingAs($admin)
            ->post('/account/account', [
                'name' => 'Caixa Principal',
                'account_number' => '0001',
                'note' => 'Conta corrente',
                'opening_balance' => '500',
            ], ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk()
            ->assertJson(['success' => true]);

        $account = Account::where('business_id', $business->id)
            ->where('name', 'Caixa Principal')
            ->firstOrFail();

        $this->assertEquals('0001', $account->account_number);

        $this->assertDatabaseHas('account_transactions', [
            'account_id' => $account->id,
            'type' => 'credit',
            'sub_type' => 'opening_balance',
            'amount' => 500,
        ]);
    }

    public function test_no_perm_user_cannot_create_an_account()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_account',
            'password' => 'secret123',
        ]);
        $viewer = $this->createNoPermUser($business, 'no_perm_account');

        $this->actingAs($viewer)
            ->post('/account/account', [
                'name' => 'Conta Suspeita',
                'account_number' => '9999',
            ], ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertForbidden();

        $this->assertDatabaseMissing('accounts', [
            'business_id' => $business->id,
            'name' => 'Conta Suspeita',
        ]);
    }

    public function test_admin_can_close_and_reactivate_an_account()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_account',
            'password' => 'secret123',
        ]);

        $account = Account::create([
            'business_id' => $business->id,
            'name' => 'Caixa Principal',
            'account_number' => '0001',
            'created_by' => $admin->id,
        ]);

        $this->actingAs($admin)
            ->get('/account/close/' . $account->id, ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk()
            ->assertJson(['success' => true]);

        $this->assertEquals(1, $account->fresh()->is_closed);

        $this->actingAs($admin)
            ->get('/account/activate/' . $account->id, ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk()
            ->assertJson(['success' => true]);

        $this->assertEquals(0, $account->fresh()->is_closed);
    }

    public function test_admin_can_transfer_funds_between_two_accounts()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_account',
            'password' => 'secret123',
        ]);

        $from = Account::create([
            'business_id' => $business->id,
            'name' => 'Caixa',
            'account_number' => '0001',
            'created_by' => $admin->id,
        ]);
        $to = Account::create([
            'business_id' => $business->id,
            'name' => 'Banco',
            'account_number' => '0002',
            'created_by' => $admin->id,
        ]);

        $this->actingAs($admin)
            ->post('/account/fund-transfer', [
                'from_account' => $from->id,
                'to_account' => $to->id,
                'amount' => '200',
                'note' => 'Transferência de teste',
                'operation_date' => now()->format('d/m/Y H:i'),
            ])
            ->assertRedirect(action('AccountController@index'));

        $debit = AccountTransaction::where('account_id', $from->id)
            ->where('type', 'debit')
            ->where('sub_type', 'fund_transfer')
            ->firstOrFail();
        $credit = AccountTransaction::where('account_id', $to->id)
            ->where('type', 'credit')
            ->where('sub_type', 'fund_transfer')
            ->firstOrFail();

        $this->assertEquals(200, (float) $debit->amount);
        $this->assertEquals(200, (float) $credit->amount);
        $this->assertEquals($credit->id, $debit->transfer_transaction_id);
        $this->assertEquals($debit->id, $credit->transfer_transaction_id);
    }

    public function test_admin_can_deposit_into_an_account_from_outside()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_account',
            'password' => 'secret123',
        ]);

        $account = Account::create([
            'business_id' => $business->id,
            'name' => 'Caixa',
            'account_number' => '0001',
            'created_by' => $admin->id,
        ]);

        $this->actingAs($admin)
            ->post('/account/deposit', [
                'account_id' => $account->id,
                'amount' => '75',
                'note' => 'Depósito externo',
                'operation_date' => now()->format('d/m/Y H:i'),
            ])
            ->assertOk()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('account_transactions', [
            'account_id' => $account->id,
            'type' => 'credit',
            'sub_type' => 'deposit',
            'amount' => 75,
        ]);
    }
}
