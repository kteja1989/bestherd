<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        // Implicitly grant "Super-Admin" role all permission checks using can()
        // added by kteja
        Gate::before(function ($user, $ability) 
        {
           if ($user->hasRole('SuperManager')) 
           {
               return true;
           }
        });
        
        /* define a super admin user role */
        Gate::define('isAdmin', function($user) {
           return $user->role == 'superadmin';
        });
       
        /* define a manager user role */
        Gate::define('isManager', function($user) {
            return $user->role == 'manager';
        });
      
        /* define a user role */
        Gate::define('isUser', function($user) {
            return $user->role == 'user';
        });
        
        /* define a user role */
        Gate::define('isGuest', function($user) {
            return $user->role == 'guest';
        });

    }
}
