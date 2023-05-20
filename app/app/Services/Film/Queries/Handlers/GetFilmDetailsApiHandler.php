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
        /** @var GetFilmDetailsQuery $query */

        $filmDetails = $this->filmApi->getFilmDetails($query->filmId);

        // Return the film details
        return $filmDetails;
    }
}
