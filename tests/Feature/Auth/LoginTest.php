<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    use CreatesBusiness;

    protected $seed = true;

    public function test_user_can_login_with_valid_credentials()
    {
        [$business, $user] = $this->createBusinessWithAdmin([
            'username' => 'jdoe',
            'password' => 'secret123',
        ]);

        $response = $this->post('/login', [
            'username' => 'jdoe',
            'password' => 'secret123',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/home');
    }

    public function test_user_cannot_login_with_invalid_password()
    {
        $this->createBusinessWithAdmin([
            'username' => 'jdoe2',
            'password' => 'secret123',
        ]);

        $response = $this->post('/login', [
            'username' => 'jdoe2',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('username');
    }

    public function test_login_fails_for_unknown_username()
    {
        $response = $this->post('/login', [
            'username' => 'does-not-exist',
            'password' => 'secret123',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('username');
    }

    public function test_user_is_logged_out_when_business_is_inactive()
    {
        [$business, $user] = $this->createBusinessWithAdmin([
            'username' => 'jdoe3',
            'password' => 'secret123',
        ]);

        $business->is_active = 0;
        $business->save();

        $response = $this->post('/login', [
            'username' => 'jdoe3',
            'password' => 'secret123',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/login');
    }
}
