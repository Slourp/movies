<?php

namespace App\Http\Controllers;

use App\DTOs\FilmDTO;
use App\Models\Film;
use App\Services\Film\Commands\AddFilmCommand;
use App\Services\Film\Commands\Handlers\AddFilmCommandHandler;
use App\Services\Film\Queries\GetFilmDetailsQuery;
use App\Services\Film\Queries\GetTrendingFilmsOfMonthQuery;
use App\Services\Film\Queries\Handlers\GetFilmDetailsApiHandler;
use App\Services\Film\Queries\Handlers\GetTrendingFilmsOfDayApiHandler;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function __construct(
        private GetTrendingFilmsOfDayApiHandler $getTrendingFilmsOfDayApiHandler,
        private GetFilmDetailsApiHandler $getFilmDetailsApiHandler,
        private AddFilmCommandHandler $addFilmCommandHandler
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filmId = 385687;
        $filmDetailsResponse = $this->getFilmDetailsApiHandler->handle(new GetFilmDetailsQuery($filmId));
        $filmDetails = (object)$filmDetailsResponse;
        // Convert JSON response to object
        // Map the film details to the FilmDTO
        $filmDTO = new FilmDTO(
            adult: $filmDetails->adult,
            backdrop_path: $filmDetails->backdrop_path,
            belongs_to_collection: $filmDetails->belongs_to_collection,
            budget: $filmDetails->budget,
            genres: $filmDetails->genres,
            homepage: $filmDetails->homepage,
            id: $filmDetails->id,
            imdb_id: $filmDetails->imdb_id,
            original_language: $filmDetails->original_language,
            original_title: $filmDetails->original_title,
            overview: $filmDetails->overview,
            popularity: $filmDetails->popularity,
            poster_path: $filmDetails->poster_path,
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
        $this->addFilmCommandHandler->handle($command);

        return 'ok';
        // $film = Film::create((array)$filmDTO);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
