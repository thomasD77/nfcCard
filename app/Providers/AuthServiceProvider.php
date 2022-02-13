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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('is_superAdmin', function ($user){
            $permission = 'is_superAdmin';
            return $user = $user->permissions()->contains($permission);
        });

        Gate::define('is_admin', function ($user){
            $permission = 'is_admin';
            return $user = $user->permissions()->contains($permission);
        });

        Gate::define('is_client', function ($user){
            $permission = 'is_client';
            return $user = $user->permissions()->contains($permission);
        });

        Gate::define('is_employee', function ($user){
            $permission = 'is_employee';
            return $user = $user->permissions()->contains($permission);
        });
    }
}
