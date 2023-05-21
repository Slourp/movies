<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        if (config('app.env') === 'local') {
            // Force HTTPS for asset URLs in production
            URL::forceScheme('https');

            // Override the asset() helper function
            URL::macro('asset', function ($path) {
                return asset($path, config('app.asset_url', null), true);
            });
        }
    }
}
