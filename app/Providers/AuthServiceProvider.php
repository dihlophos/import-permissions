<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Policies\ExportPolicy;
use App\Models\Export;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Export::class => ExportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('specify-export-permission', function ($user, $organization) {
            return $user->isAdmin() || ($user->roleName() === "depadmin");
        });

        Gate::define('modify-export', function ($user, $organization) {
            return $user->isAdmin() || ($user->roleName() === "depadmin") || ($user->roleName() === "instadmin");
        });

        Gate::define('view-export', function ($user, $organization) {
            return true;
        });

        Gate::define('process-export', function ($user, $organization) {
            return $user->RoleName() === "instspec";
        });

        Gate::define('access-lists', function ($user) {
            return $user->isAdmin();
        });
    }
}
