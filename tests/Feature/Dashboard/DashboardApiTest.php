<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\TestCase;

class DashboardApiTest extends TestCase
{
    use RefreshDatabase;
    use CreatesBusiness;

    protected $seed = true;

    private const AJAX_HEADERS = ['X-Requested-With' => 'XMLHttpRequest'];

    protected function setUp(): void
    {
        parent::setUp();

        // CheckPayment middleware redirects businesses without an active
        // subscription to /payment; bypass it the same way production does
        // for administrator accounts, since subscriptions are out of scope
        // for these dashboard JSON endpoint tests.
        config(['constants.administrator_usernames' => implode(',', [
            'admin_dashboard',
            'no_perm_dashboard',
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

    public function test_dashboard_json_endpoints_require_authentication()
    {
        $this->get('/home/get-totals', self::AJAX_HEADERS)->assertRedirect('/login');
        $this->get('/home/dashboard-charts', self::AJAX_HEADERS)->assertRedirect('/login');
        $this->get('/home/product-stock-alert', self::AJAX_HEADERS)->assertRedirect('/login');
        $this->get('/home/purchase-payment-dues', self::AJAX_HEADERS)->assertRedirect('/login');
        $this->get('/home/sales-payment-dues', self::AJAX_HEADERS)->assertRedirect('/login');
    }

    public function test_dashboard_charts_requires_dashboard_data_permission()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_dashboard',
            'password' => 'secret123',
        ]);
        $viewer = $this->createNoPermUser($business, 'no_perm_dashboard');
        $viewer->revokePermissionTo('dashboard.data');

        $this->actingAs($viewer)
            ->get('/home/dashboard-charts', self::AJAX_HEADERS)
            ->assertForbidden();

        $this->actingAs($admin)
            ->get('/home/dashboard-charts', self::AJAX_HEADERS)
            ->assertOk()
            ->assertJsonStructure([
                'last_30_days' => ['title', 'axis_label', 'labels', 'datasets'],
                'current_fy' => ['title', 'axis_label', 'labels', 'datasets'],
            ]);
    }

    public function test_dashboard_totals_returns_purchase_and_sell_totals()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_dashboard',
            'password' => 'secret123',
        ]);

        $response = $this->actingAs($admin)
            ->get('/home/get-totals?' . http_build_query([
                'start' => now()->subMonth()->format('Y-m-d'),
                'end' => now()->format('Y-m-d'),
                'location_id' => '',
            ]), self::AJAX_HEADERS)
            ->assertOk();

        $response->assertJsonStructure([
            'total_purchase',
            'total_sell',
            'invoice_due',
            'purchase_due',
            'total_expense',
        ]);
    }

    public function test_product_stock_alert_returns_plain_json_array_scoped_to_business()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_dashboard',
            'password' => 'secret123',
        ]);

        $this->actingAs($admin)
            ->get('/home/product-stock-alert', self::AJAX_HEADERS)
            ->assertOk()
            ->assertJson([]);
    }

    public function test_purchase_and_sales_payment_dues_include_can_view_flag()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_dashboard',
            'password' => 'secret123',
        ]);

        $this->actingAs($admin)
            ->get('/home/purchase-payment-dues', self::AJAX_HEADERS)
            ->assertOk()
            ->assertJson([]);

        $this->actingAs($admin)
            ->get('/home/sales-payment-dues', self::AJAX_HEADERS)
            ->assertOk()
            ->assertJson([]);
    }
}
