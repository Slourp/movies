<?php

namespace App\Services\Film\Queries\Handlers;


use App\Services\Film\FilmApiInterface;
use App\Services\Film\Queries\FilmQueryInterface;
use App\Services\Film\Queries\Handlers\GetFilmQueryInterface;

class SearchFilmsApiHandler implements GetFilmQueryInterface
{
    public function __construct(private FilmApiInterface $filmApi)
    {
    }

    public function handle(FilmQueryInterface $query): array|object|null
    {
        // Use $this->filmApi to interact with the Film API and retrieve the search films
        $searchedFilms = $this->filmApi->searchFilms($query->searchTerm, $query->page);

        // Return the searched films
        return $searchedFilms;
    }
}
