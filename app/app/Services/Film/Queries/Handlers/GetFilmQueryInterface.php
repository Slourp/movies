<?php

namespace App\Services\Film\Queries\Handlers;

use App\Services\Film\Queries\FilmQueryInterface;

interface GetFilmQueryInterface
{
    /**
     * Handle the query and retrieve the film details.
     *
     * @param int $filmId
     * @return array|object|null
     */
    public function handle(FilmQueryInterface $query): array|object|null;
}
