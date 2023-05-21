<?php

namespace App\Console\Commands;

use App\DTOs\FilmDTO;
use App\Services\Film\Commands\AddFilmCommand;
use App\Services\Film\Commands\Handlers\AddFilmCommandHandler;
use App\Services\Film\Commands\Handlers\UpdateOrCreateFilmCommandHandler;
use App\Services\Film\Queries\GetFilmDetailsQuery;
use App\Services\Film\Queries\GetTrendingFilmsOfDayQuery;
use App\Services\Film\Queries\Handlers\GetFilmDetailsApiHandler;
use App\Services\Film\Queries\Handlers\GetTrendingFilmsOfDayApiHandler;
use Illuminate\Console\Command;
use Throwable;

class ResyncFilmsCommand extends Command
{
    public function __construct(
        private GetTrendingFilmsOfDayApiHandler $getTrendingFilmsOfDayApiHandler,
        private UpdateOrCreateFilmCommandHandler $updateOrCreateFilmCommandHandler,
        private GetFilmDetailsApiHandler $getFilmDetailsApiHandler
    ) {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'films:resync';

    /**
     * The console command description.
     *$
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $trendingFilms = $this->getTrendingFilmsOfDayApiHandler->handle(new GetTrendingFilmsOfDayQuery);
        $filmIds = array_column($trendingFilms["results"], 'id');

        $retryAttempts = 10;
        $initialDelay = 1; // Initial delay in seconds
        $maxDelay = 64; // Maximum delay in seconds

        array_walk($filmIds, function ($filmId) use ($retryAttempts, $initialDelay, $maxDelay) {
            $retryDelay = $initialDelay;

            for ($attempt = 1; $attempt <= $retryAttempts; $attempt++) {
                try {
                    $filmDetailsResponse = $this->getFilmDetailsApiHandler->handle(new GetFilmDetailsQuery($filmId));
                    $filmDetails = (object) $filmDetailsResponse;
                    // Convert JSON response to object
                    // Map the film details to the FilmDTO
                    $filmDTO = new FilmDTO(
                        adult: $filmDetails->adult,
                        backdrop_path: $filmDetails?->backdrop_path ?? "",
                        belongs_to_collection: $filmDetails?->belongs_to_collection ?? [],
                        budget: $filmDetails->budget,
                        genres: $filmDetails->genres,
                        homepage: $filmDetails->homepage,
                        id: $filmDetails->id,
                        imdb_id: $filmDetails->imdb_id,
                        original_language: $filmDetails->original_language,
                        original_title: $filmDetails->original_title,
                        overview: $filmDetails->overview,
                        popularity: $filmDetails->popularity,
                        poster_path: $filmDetails?->poster_path ? "https://image.tmdb.org/t/p/original$filmDetails?->poster_path" : "",
                        production_companies: $filmDetails->production_companies,
                        production_countries: $filmDetails->production_countries,
                        release_date: $filmDetails->release_date,
                        revenue: $filmDetails->revenue,
                        runtime: $filmDetails->runtime,
                        spoken_languages: $filmDetails->spoken_languages,
                        status: $filmDetails->status,
                        tagline: $filmDetails->tagline,
                        title: $filmDetails->title,
                        video: $filmDetails->video,
                        vote_average: $filmDetails->vote_average,
                        vote_count: $filmDetails->vote_count,
                    );


                    $command = new AddFilmCommand($filmDTO);
                    $this->updateOrCreateFilmCommandHandler->handle($command);

                    dump("[$filmDetails->id] $filmDetails->original_title");
                    sleep(2);

                    // Break the retry loop if successful
                    break;
                } catch (Throwable $exception) {
                    if ($attempt === $retryAttempts) {
                        // Retry attempts exceeded, handle the error or throw an exception
                        // ...
                        break;
                    }

                    // Retry the operation with an increasing delay
                    sleep($retryDelay);
                    $retryDelay = min($retryDelay * 2, $maxDelay);
                }
            }
        });
    }
}
