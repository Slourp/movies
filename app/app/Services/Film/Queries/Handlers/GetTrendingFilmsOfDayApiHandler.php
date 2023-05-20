<?php

namespace App\Services\Film\Queries\Handlers;

use App\Services\Film\FilmApiInterface;
use App\Services\Film\Queries\FilmQueryInterface;
use App\Services\Film\Queries\Handlers\GetFilmQueryInterface;

class GetTrendingFilmsOfDayApiHandler implements GetFilmQueryInterface
{
    public function __construct(private FilmApiInterface $filmApi)
    {
    }

    public function handle(FilmQueryInterface $query): array|object|null
    {
        // Use $this->filmApi to interact with the Film API and retrieve the trending films of the day
        // Implement the logic to handle the GetTrendingFilmsOfDayQuery

        // Example usage:
        $trendingFilms = $this->filmApi->getTrendingFilmsOfDay();

        // Return the trending films of the day
        return $trendingFilms;
    }
}
