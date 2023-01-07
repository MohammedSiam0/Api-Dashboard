<?php

namespace App\Providers;

use Carbon\Carbon;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
          'App\Models\Admin' => 'App\Policies\AdminPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    { 
        $this->registerPolicies();
        // ال  passport الها راوت خاص فيها 
        Passport::routes();
        // من هنا تم تقليل وقت تلف التوكن 
        //PERSONAL
        Passport::personalAccessTokensExpireIn(Carbon::now()->addMonths(3));
        //PGCT
        Passport::tokensExpireIn(Carbon::now()->addDays(10));
    }
}
