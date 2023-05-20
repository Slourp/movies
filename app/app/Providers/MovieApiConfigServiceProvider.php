<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MovieApiConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/film-api.php',
            'film-api'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
