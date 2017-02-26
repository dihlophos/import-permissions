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

        Gate::define('specify-export-permission', function ($user, $institution_id) {
            if ($user->isAdmin()) { return true; }

            if ($user->roleName() === "depadmin") { return true; }
            
            return false;
        });

        Gate::define('modify-export', function ($user, $institution_id) {
            
            if ($user->isAdmin()) { return true; }

            if ($user->roleName() === "depadmin") { return true; }

            if ($user->roleName() === "instadmin")
            {
                return $user->institution_id === $institution_id;
            }

            return false;
        });

        Gate::define('view-export', function ($user, $institution_id) {
            if ($user->isAdmin()) { return true; }

            if ($user->roleName() === "depadmin") { return true; }

            return $user->institution_id === $institution_id;
        });

        Gate::define('process-export', function ($user, $institution_id) {

            if ($user->isAdmin()) { return true; }

            if ($user->roleName() === "instspec") { return $user->institution_id === $institution_id; }
            
            return false;
        });

        Gate::define('access-lists', function ($user) {
            return $user->isAdmin();
        });
    }
}
