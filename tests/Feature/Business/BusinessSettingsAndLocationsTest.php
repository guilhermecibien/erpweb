<?php

namespace Tests\Feature\Business;

use App\Models\BusinessLocation;
use App\Utils\BusinessUtil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\Concerns\CreatesBusiness;
use Tests\TestCase;

class BusinessSettingsAndLocationsTest extends TestCase
{
    use RefreshDatabase;
    use CreatesBusiness;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();

        // These routes also go through CheckPayment (active subscription), which
        // is unrelated to the business-settings/location permission checks under
        // test here. Bypass it the same way production does for administrators.
        config(['constants.administrator_usernames' => 'admin_settings,admin_locations,limited_user,admin_perm_locations,restricted_user']);
    }

    public function test_admin_can_view_business_settings_but_user_without_permission_cannot()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_settings',
            'password' => 'secret123',
        ]);

        $this->actingAs($admin)
            ->get('/business/settings')
            ->assertOk();

        $role = Role::create(['name' => 'SemAcesso#' . $business->id, 'business_id' => $business->id]);

        $limitedUser = \App\Models\User::create_user([
            'surname' => '',
            'first_name' => 'Sem',
            'last_name' => 'Acesso',
            'username' => 'limited_user',
            'email' => 'limited_user@example.com',
            'password' => 'secret123',
            'language' => 'pt',
        ]);
        $limitedUser->business_id = $business->id;
        $limitedUser->save();
        $limitedUser->assignRole($role->name);
        $limitedUser = $limitedUser->fresh();

        $this->actingAs($limitedUser)
            ->get('/business/settings')
            ->assertForbidden();
    }

    public function test_only_users_with_business_settings_access_can_manage_locations()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_locations',
            'password' => 'secret123',
        ]);

        $this->actingAs($admin)
            ->get('/business-location')
            ->assertOk();

        $role = Role::create(['name' => 'SemAcesso#' . $business->id, 'business_id' => $business->id]);

        $limitedUser = \App\Models\User::create_user([
            'surname' => '',
            'first_name' => 'Sem',
            'last_name' => 'Acesso',
            'username' => 'limited_user',
            'email' => 'limited_user@example.com',
            'password' => 'secret123',
            'language' => 'pt',
        ]);
        $limitedUser->business_id = $business->id;
        $limitedUser->save();
        $limitedUser->assignRole($role->name);
        $limitedUser = $limitedUser->fresh();

        $this->actingAs($limitedUser)
            ->get('/business-location')
            ->assertForbidden();

        $this->actingAs($limitedUser)
            ->post('/business-location', ['name' => 'Filial Indevida'])
            ->assertForbidden();
    }

    public function test_permitted_locations_respects_location_specific_permissions()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_perm_locations',
            'password' => 'secret123',
        ]);

        $businessUtil = app(BusinessUtil::class);
        $secondLocation = $businessUtil->addLocation($business->id, [
            'name' => 'Filial 2',
            'landmark' => 'Av. Secundaria, 100',
            'city' => 'Campinas',
            'state' => 'SP',
            'zip_code' => '13000-000',
            'country' => 'Brasil',
        ]);

        $firstLocation = BusinessLocation::where('business_id', $business->id)
            ->where('id', '!=', $secondLocation->id)
            ->firstOrFail();

        Permission::firstOrCreate(['name' => 'location.' . $firstLocation->id]);

        $role = Role::create(['name' => 'UnicaFilial#' . $business->id, 'business_id' => $business->id]);
        $role->syncPermissions(['sell.view', 'location.' . $firstLocation->id]);

        $restrictedUser = \App\Models\User::create_user([
            'surname' => '',
            'first_name' => 'Restrito',
            'last_name' => 'Teste',
            'username' => 'restricted_user',
            'email' => 'restricted_user@example.com',
            'password' => 'secret123',
            'language' => 'pt',
        ]);
        $restrictedUser->business_id = $business->id;
        $restrictedUser->save();
        $restrictedUser->assignRole($role->name);
        $restrictedUser = $restrictedUser->fresh();

        // permitted_locations() reads business_id from the session, which is
        // only populated by SetSessionData once a request has gone through it.
        $this->actingAs($restrictedUser)->get('/home');

        $this->assertEquals([$firstLocation->id], $restrictedUser->permitted_locations());
        $this->assertTrue($restrictedUser->can_access_this_location($firstLocation->id));
        $this->assertFalse($restrictedUser->can_access_this_location($secondLocation->id));

        // The default Admin role carries access_all_locations, so it isn't
        // scoped to any specific set of locations.
        $this->actingAs($admin)->get('/home');
        $this->assertEquals('all', $admin->fresh()->permitted_locations());
    }
}
