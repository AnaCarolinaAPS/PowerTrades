<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Cliente;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('eAdmin', function ($user) {
            return ($user->admin === 'adm' ? true : ($user->admin === 'log' ? true : $user->admin === 'fin'));
        });

        Gate::define('eAdm', function ($user) {
            return $user->admin === 'adm';
        });

        Gate::define('eLog', function ($user) {
            return $user->admin === 'log';
        });

        Gate::define('eFin', function ($user) {
            return $user->admin === 'fin';
        });

        Gate::define('eCli', function ($user) {
            return (is_null($user->admin));
        });
    }
}
