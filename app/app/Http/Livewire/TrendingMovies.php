<?php

namespace App\Http\Livewire;

use App\Handlers\GetTrendingFilmsOfDayApiHandler;
use App\Jobs\ProcessFilmRequestJob;
use App\Queries\GetTrendingFilmsOfDayQuery;
use App\Services\Film\FilmApiClient;
use App\Services\Film\FilmApiInterface;
use App\Services\Film\Queries\GetTrendingFilmsOfDayQuery as QueriesGetTrendingFilmsOfDayQuery;
use App\Services\Film\Queries\Handlers\GetFilmDetailsApiHandler;
use App\Services\Film\Queries\Handlers\GetTrendingFilmsOfDayApiHandler as HandlersGetTrendingFilmsOfDayApiHandler;
use Livewire\Component;

class TrendingMovies extends Component
{
    private FilmApiInterface $api;
    public function __construct()
    {
        $baseUrl = config('film-api.moviedb.url');
        $token = config('film-api.moviedb.token');
        $this->api = new FilmApiClient($baseUrl, $token);
    }


    public bool $isOpen = false;
    public array $films = [];
    public int $currentPage = 1;
    public int $perPage = 20;
    public int $totalResults = 0;

    public function render()
    {
        $baseUrl = config('film-api.moviedb.url');
        $token = config('film-api.moviedb.token');

        // Create an instance of the FilmApiClient
        $filmApiClient = new FilmApiClient($baseUrl, $token);

        // Create an instance of the GetTrendingFilmsOfDayApiHandler
        $getTrendingFilmsOfDayApiHandler = new HandlersGetTrendingFilmsOfDayApiHandler($filmApiClient);

        // Fetch the trending movies from the API for the specified page
        $response = $getTrendingFilmsOfDayApiHandler->handle(new QueriesGetTrendingFilmsOfDayQuery($this->currentPage));

        // Extract the data from the API response
        $this->films = $response['results'];
        $this->totalResults = $response['total_results'];
        $this->currentPage = $response['page'];

        // Calculate the total pages
        $totalPages = $this->totalPages();

        // Pass the component properties and the total pages to the view
        return view('livewire.trending-movies', [
            'films' => $this->films,
            'currentPage' => $this->currentPage,
            'totalPages' => $totalPages,
        ]);
    }

    public function addSelectedFilmsToDatabase($filmId)
    {
        ProcessFilmRequestJob::dispatch(new GetFilmDetailsApiHandler($this->api), $filmId)
            ->onQueue('film_requests');
        session()->flash('message', 'Selected films added to the database.');
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function nextPage()
    {
        if ($this->currentPage < $this->totalPages()) {
            $this->currentPage++;
        }
    }

    public function totalPages()
    {
        return ceil($this->totalResults / $this->perPage);
    }

    public function gotoPage($page)
    {
        $this->currentPage = $page;
    }
}
