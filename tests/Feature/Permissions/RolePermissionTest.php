<?php

namespace Tests\Feature\Permissions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\Concerns\CreatesBusiness;
use Tests\TestCase;

class RolePermissionTest extends TestCase
{
    use RefreshDatabase;
    use CreatesBusiness;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();

        // These routes are gated by CheckPayment (active subscription), which is
        // unrelated to the role/permission behaviour under test here. Bypass it
        // the same way production does for administrator accounts.
        config(['constants.administrator_usernames' => 'admin_rbac,admin_cashier_owner,cashier_user,admin_custom_owner,stock_user']);
    }

    public function test_admin_bypasses_permission_checks_via_role_gate()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_rbac',
            'password' => 'secret123',
        ]);

        $this->actingAs($admin)
            ->get('/roles')
            ->assertOk();

        $this->actingAs($admin)
            ->get('/products')
            ->assertOk();
    }

    public function test_cashier_role_can_access_sales_but_not_roles_or_products()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_cashier_owner',
            'password' => 'secret123',
        ]);

        $cashier = \App\Models\User::create_user([
            'surname' => '',
            'first_name' => 'Caixa',
            'last_name' => 'Teste',
            'username' => 'cashier_user',
            'email' => 'cashier_user@example.com',
            'password' => 'secret123',
            'language' => 'pt',
        ]);
        $cashier->business_id = $business->id;
        $cashier->save();
        $cashier->assignRole('Caixa#' . $business->id);
        // create_user() doesn't hydrate DB column defaults (e.g. user_type) into
        // the returned instance, so re-fetch before authenticating as it.
        $cashier = $cashier->fresh();

        $this->actingAs($cashier)
            ->get('/sells')
            ->assertOk();

        $this->actingAs($cashier)
            ->get('/roles')
            ->assertForbidden();

        $this->actingAs($cashier)
            ->get('/products')
            ->assertForbidden();
    }

    public function test_custom_role_only_grants_synced_permissions()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_custom_owner',
            'password' => 'secret123',
        ]);

        $role = Role::create([
            'name' => 'Estoquista#' . $business->id,
            'business_id' => $business->id,
        ]);
        $role->syncPermissions(['product.view']);

        $stockUser = \App\Models\User::create_user([
            'surname' => '',
            'first_name' => 'Estoque',
            'last_name' => 'Teste',
            'username' => 'stock_user',
            'email' => 'stock_user@example.com',
            'password' => 'secret123',
            'language' => 'pt',
        ]);
        $stockUser->business_id = $business->id;
        $stockUser->save();
        $stockUser->assignRole($role->name);
        $stockUser = $stockUser->fresh();

        $this->actingAs($stockUser)
            ->get('/products')
            ->assertOk();

        $this->actingAs($stockUser)
            ->get('/roles')
            ->assertForbidden();

        $this->actingAs($stockUser)
            ->get('/sells')
            ->assertForbidden();
    }
}
