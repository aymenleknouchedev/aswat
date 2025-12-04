<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Services\WeatherService;

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

        Paginator::useBootstrapFour(); 
        Schema::defaultStringLength(191);

        Blade::if('canDo', function ($permission) {
            $user = request()->user();
            return $user && $user->hasPermission($permission);
        });

        // Share weather data with fixed nav component only
        View::composer('user.components.fixed-nav', function ($view) {
            try {
                $weather = app(WeatherService::class)->current();
            } catch (\Throwable $e) {
                $weather = null;
            }
            $view->with('weather', $weather);
        });
    }
}
