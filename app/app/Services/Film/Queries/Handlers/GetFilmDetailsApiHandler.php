<?php

namespace App\Services\Film\Queries\Handlers;

use App\Services\Film\Queries\GetFilmDetailsQuery;
use App\Services\Film\FilmApiInterface;
use App\Services\Film\Queries\FilmQueryInterface;

class GetFilmDetailsApiHandler implements GetFilmQueryInterface
{

    public function __construct(
        private FilmApiInterface $filmApi
    ) {
    }

    public function handle(FilmQueryInterface $query): array|object|null
    {
        // Use $this->filmApi to interact with the Film API and retrieve the film details
        // Implement the logic to handle the GetFilmDetailsQuery

        // Example usage:
        $filmDetails = $this->filmApi->getFilmDetails($query->id);

        // Return the film details
        return $filmDetails;
    }
}
