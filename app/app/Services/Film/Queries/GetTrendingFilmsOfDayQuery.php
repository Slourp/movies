<?php

namespace App\Services\Film\Queries;


class GetTrendingFilmsOfDayQuery implements FilmQueryInterface
{
    public function __construct(public readonly int $page = 1)
    {
    }
}
