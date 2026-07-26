<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if (in_array($ability, ['backup', 'superadmin', 'manage_modules'])) {
                $administrator_list = config('constants.administrator_usernames', '');
                $administrators = array_filter(array_map(function ($username) {
                    return strtolower(trim((string) $username));
                }, explode(',', (string) $administrator_list)));

                if (in_array(strtolower(trim((string) $user->username)), $administrators, true)) {
                    return true;
                }
            } else {
                if ($user->hasRole('Admin#' . $user->business_id)) {
                    return true;
                }
            }
        });
    }
}
