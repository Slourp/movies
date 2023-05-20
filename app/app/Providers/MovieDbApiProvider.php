<?php

namespace App\Providers;

use App\Services\Film\FilmApiClient;
use App\Services\Film\FilmApiInterface;
use Illuminate\Support\ServiceProvider;

class MovieDbApiProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(FilmApiInterface::class, function () {
            $baseUrl = config('film-api.moviedb.url');
            $token = config('film-api.moviedb.token');
            return new FilmApiClient($baseUrl, $token);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
