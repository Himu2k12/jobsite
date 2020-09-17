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

        Gate::define('isCompany',function ($user){
            if($user->role==2){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('isApplicant',function ($user){
           if ($user->role==1){
               return true;
           } else{
               return false;
           }
        });
    }
}
