<?php

namespace App\Providers;

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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    protected static $allowRoutes = [
        'admin.index',
        'admin.auth.logout'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //超级管理员
        Gate::before(function ($user, $ability) {
            if ($user->is_super || in_array($ability, self::$allowRoutes)) {
                return true;
            }
        });
    }
}
