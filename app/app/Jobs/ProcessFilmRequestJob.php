<?php

namespace App\Jobs;

use App\DTOs\FilmDTO;
use App\Models\Film;
use App\Services\Film\Commands\Handlers\AddFilmCommandHandler;
use App\Services\Film\Queries\GetFilmDetailsQuery;
use App\Services\Film\Queries\Handlers\GetFilmDetailsApiHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessFilmRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     */

    public function __construct(
        private GetFilmDetailsApiHandler $getFilmDetailsApiHandler,
        private int $filmId
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filmDetailsResponse = $this->getFilmDetailsApiHandler->handle(new GetFilmDetailsQuery($this->filmId));
        $filmDetails = (object) $filmDetailsResponse;

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
            poster_path: $filmDetails?->poster_path ?? "",
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

        Film::updateOrCreate(
            ['id' => $filmDTO->id],
            (array) $filmDTO
        );

        dump($filmDTO->id);
    }
}
