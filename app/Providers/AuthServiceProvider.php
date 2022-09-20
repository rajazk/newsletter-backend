<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        if (!$this->app->routesAreCached()) {
            Passport::routes();
            // Passport::routes(null, ['prefix' => 'api/oauth']);
        }
        Passport::tokensExpireIn(now()->addMinutes(5));  //addDays
        Passport::refreshTokensExpireIn(now()->addMinutes(5)); //addDays
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
