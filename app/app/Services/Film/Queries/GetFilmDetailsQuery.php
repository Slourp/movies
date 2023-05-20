<?php

namespace App\Services\Film\Queries;


class GetFilmDetailsQuery implements FilmQueryInterface
{

    public function __construct(
        public readonly int $filmId
    ) {
    }
}
