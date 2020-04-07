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

        Gate::define('acr-request-access', function ($user) {
            return $user->hasAnyRole(['ROLE_ACR_REQUEST_ACCESS']);
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

        Gate::define('gazetted-officer', function ($user) {
            return $user->hasAnyRole(['ROLE_GAZETTED_OFFICER']);
        });

        Gate::define('non-gazetted-officer', function ($user) {
            return $user->hasAnyRole(['ROLE_NON_GAZETTED_OFFICER']);
        });

        Gate::define('site-admin', function ($user) {
            return $user->hasAnyRole(['ROLE_SITE_ADMIN']);
        });
        Gate::define('gazetted-cadre-officer', function ($user) {
                return $user->hasAnyRole(['ROLE_GAZETTED_CADRE_OFFICER']);
        });

    }
}
