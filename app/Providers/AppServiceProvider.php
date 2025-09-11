<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Paginator::useBootstrapFour(); // or useBootstrapFour()


        Blade::if('canDo', function ($permission) {
            $user = request()->user();   // safer than Auth::user()
            return $user && $user->hasPermission($permission);
        });
    }
}
