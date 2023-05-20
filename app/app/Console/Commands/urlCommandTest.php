<?php

namespace App\Console\Commands;

use App\Services\Film\Queries\GetFilmDetailsQuery;
use App\Services\Film\Queries\GetTrendingFilmsOfDayQuery;
use App\Services\Film\Queries\GetTrendingFilmsOfMonthQuery;
use App\Services\Film\Queries\Handlers\GetFilmDetailsApiHandler;
use App\Services\Film\Queries\Handlers\GetTrendingFilmsOfDayApiHandler;
use App\Services\Film\Queries\Handlers\GetTrendingFilmsOfMonthApiHandler;
use Illuminate\Console\Command;

class urlCommandTest extends Command
{
    public function __construct(
        private GetTrendingFilmsOfDayApiHandler $getTrendingFilmsOfDayHandler,
        private GetTrendingFilmsOfMonthApiHandler $getTrendingFilmsOfMonthHandler,
        private GetFilmDetailsApiHandler $getFilmDetailsHandler
    ) {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:fire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Example usage of GetTrendingFilmsOfDayHandler
        $trendingFilmsOfDayQuery = new GetTrendingFilmsOfDayQuery();
        $trendingFilmsOfDay = $this->getTrendingFilmsOfDayHandler->handle($trendingFilmsOfDayQuery);
        // dd($trendingFilmsOfDay);

        // Example usage of GetTrendingFilmsOfMonthHandler
        $trendingFilmsOfMonthQuery = new GetTrendingFilmsOfMonthQuery();
        $trendingFilmsOfMonth = $this->getTrendingFilmsOfMonthHandler->handle($trendingFilmsOfMonthQuery);
        // dd($trendingFilmsOfMonth);

        // Example usage of GetFilmDetailsHandler
        $filmId = 123; // Replace with the actual film ID
        $filmDetailsQuery = new GetFilmDetailsQuery($filmId);
        $filmDetails = $this->getFilmDetailsHandler->handle($filmDetailsQuery);
        dd($filmDetails);

        dd([
            'url' => config('film-api.moviedb.url'),
            'token' => config('film-api.moviedb.token')
        ]);
    }
}
