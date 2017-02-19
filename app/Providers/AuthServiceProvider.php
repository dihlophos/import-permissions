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

        Gate::define('access-lists', function ($user) {
            return $user->isAdmin();
        });
    }
}
