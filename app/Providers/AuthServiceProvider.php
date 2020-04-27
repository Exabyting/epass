<?php

namespace App\Providers;

use App\Entities\Role;
use App\Policies\RolePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('hrm-access', function ($user) {
            return $user->hasAnyRole(['ROLE_HRM_ACCESS']);
        });

        Gate::define('hrm-setting-access', function ($user) {
            return $user->hasAnyRole(['ROLE_HRM_SETTING_ACCESS']);
        });

        Gate::define('officer-request-access', function ($user) {
            return $user->hasAnyRole(['ROLE_OFFICER_REQUEST_ACCESS']);
        });

        Gate::define('system-analyst', function ($user) {
            return $user->hasAnyRole(['ROLE_SYSTEM_ANALYST']);
        });

        Gate::define('system-super-admin', function ($user) {
            return $user->hasAnyRole(['ROLE_SUPER_ADMIN']);
        });

        Gate::define('special-user', function ($user) {
            return $user->hasAnyRole(['ROLE_SPECIAL_ACCESS']);
        });

        Gate::define('site-admin', function ($user) {
            return $user->hasAnyRole(['ROLE_SITE_ADMIN']);
        });

    }
}
