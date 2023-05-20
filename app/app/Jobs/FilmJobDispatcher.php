<?php

namespace App\Jobs;

use App\Services\Film\Commands\Handlers\AddFilmCommandHandler;
use App\Services\Film\FilmApiInterface;
use App\Services\Film\Queries\GetTrendingFilmsOfDayQuery;
use App\Services\Film\Queries\Handlers\GetFilmDetailsApiHandler;
use App\Services\Film\Queries\Handlers\GetTrendingFilmsOfDayApiHandler;

class FilmJobDispatcher
{
    public function __construct(
        private GetTrendingFilmsOfDayApiHandler $getTrendingFilmsOfDayApiHandler,
        private AddFilmCommandHandler $addFilmCommandHandler,
        private FilmApiInterface $api
    ) {
    }

    public function dispatchFilmJobs(): void
    {
        $trendingFilms = $this->getTrendingFilmsOfDayApiHandler->handle(new GetTrendingFilmsOfDayQuery);

        $filmIds = array_column($trendingFilms["results"], 'id');

        array_walk(
            $filmIds,
            fn ($filmId) => ProcessFilmRequestJob::dispatch(new GetFilmDetailsApiHandler($this->api), $filmId)
                ->onQueue('film_requests')
                ->delay(now()->addSeconds(10)) // Optional delay, if needed
        );
    }
}
