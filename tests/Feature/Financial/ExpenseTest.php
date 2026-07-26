<?php

namespace Tests\Feature\Financial;

use App\Models\ExpenseCategory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\TestCase;

class ExpenseTest extends TestCase
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
        // for these controller tests.
        config(['constants.administrator_usernames' => implode(',', [
            'admin_expense',
            'no_perm_expense',
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
     * Mirrors ExpenseController::$dummyPaymentLine - TransactionUtil::createOrUpdatePaymentLines()
     * reads every one of these keys directly (no isset()).
     */
    private function expensePaymentPayload(string $amount): array
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

    public function test_expense_category_index_requires_expense_access_permission()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_expense',
            'password' => 'secret123',
        ]);
        $viewer = $this->createNoPermUser($business, 'no_perm_expense');

        $this->actingAs($viewer)
            ->get('/expense-categories')
            ->assertForbidden();

        $this->actingAs($admin)
            ->get('/expense-categories')
            ->assertOk();
    }

    public function test_admin_can_create_update_and_delete_an_expense_category()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_expense',
            'password' => 'secret123',
        ]);

        $this->actingAs($admin)
            ->post('/expense-categories', [
                'name' => 'Aluguel',
                'code' => 'ALG',
            ], ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk()
            ->assertJson(['success' => true]);

        $category = ExpenseCategory::where('business_id', $business->id)
            ->where('name', 'Aluguel')
            ->firstOrFail();

        $this->actingAs($admin)
            ->put('/expense-categories/' . $category->id, [
                'name' => 'Aluguel e condomínio',
                'code' => 'ALG',
            ], ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk()
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('expense_categories', [
            'id' => $category->id,
            'name' => 'Aluguel e condomínio',
        ]);

        $this->actingAs($admin)
            ->delete('/expense-categories/' . $category->id, [], ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk()
            ->assertJson(['success' => true]);

        $this->assertSoftDeleted('expense_categories', ['id' => $category->id]);
    }

    public function test_expense_create_screen_requires_an_active_subscription()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_expense',
            'password' => 'secret123',
        ]);

        $this->actingAs($admin)
            ->get('/expenses/create')
            ->assertRedirect(action('ExpenseController@index'));
    }

    public function test_no_perm_user_cannot_access_expenses_index()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_expense',
            'password' => 'secret123',
        ]);
        $viewer = $this->createNoPermUser($business, 'no_perm_expense');

        $this->actingAs($viewer)
            ->get('/expenses')
            ->assertForbidden();
    }

    public function test_admin_can_create_an_expense_with_payment()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_expense',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();
        $category = ExpenseCategory::create([
            'business_id' => $business->id,
            'name' => 'Contas',
            'code' => 'CONT',
        ]);

        $this->actingAs($admin)
            ->post('/expenses', [
                'location_id' => $location->id,
                'transaction_date' => now()->format('d/m/Y H:i'),
                'final_total' => '150',
                'expense_category_id' => $category->id,
                'additional_notes' => 'Conta de luz',
                'payment' => [$this->expensePaymentPayload('150')],
            ])
            ->assertRedirect('expenses');

        $expense = Transaction::where('business_id', $business->id)
            ->where('type', 'expense')
            ->firstOrFail();

        $this->assertEquals(150, (float) $expense->final_total);
        $this->assertEquals($category->id, $expense->expense_category_id);
        $this->assertEquals('paid', $expense->payment_status);

        $this->assertDatabaseHas('transaction_payments', [
            'transaction_id' => $expense->id,
            'amount' => 150,
            'method' => 'cash',
        ]);
    }

    public function test_admin_can_delete_an_expense()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_expense',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($business, $admin);

        $location = $business->locations()->first();

        $this->actingAs($admin)->post('/expenses', [
            'location_id' => $location->id,
            'transaction_date' => now()->format('d/m/Y H:i'),
            'final_total' => '80',
            'payment' => [$this->expensePaymentPayload('80')],
        ]);

        $expense = Transaction::where('business_id', $business->id)
            ->where('type', 'expense')
            ->firstOrFail();

        $this->actingAs($admin)
            ->delete('/expenses/' . $expense->id, [], ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk()
            ->assertJson(['success' => true]);

        $this->assertDatabaseMissing('transactions', ['id' => $expense->id]);
    }
}
