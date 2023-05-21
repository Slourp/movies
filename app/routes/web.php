<?php

use App\Http\Livewire\Films;
use App\Http\Livewire\Products;
use App\Services\Film\FilmApiClient;
use App\Services\Film\Queries\GetTrendingFilmsOfDayQuery;
use App\Services\Film\Queries\Handlers\GetTrendingFilmsOfDayApiHandler;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('products', Films::class)->middleware('auth')->name('products');

Route::get('films', Films::class)->middleware('auth')->name('films');

Route::get('trendeing-by-month', function () {
    // Your code logic for trending products by month goes here
    $baseUrl = config('film-api.moviedb.url');
    $token = config('film-api.moviedb.token');
    $getTrendingFilmsOfDayApiHandler = new GetTrendingFilmsOfDayApiHandler(new FilmApiClient($baseUrl, $token));
    return $getTrendingFilmsOfDayApiHandler->handle(new GetTrendingFilmsOfDayQuery());
})->middleware('auth')->name('trending.by.month');

Route::get('trendeing-by-day', function () {
    // Your code logic for trending products by day goes here
    $baseUrl = config('film-api.moviedb.url');
    $token = config('film-api.moviedb.token');
    $getTrendingFilmsOfDayApiHandler = new GetTrendingFilmsOfDayApiHandler(new FilmApiClient($baseUrl, $token));
    return $getTrendingFilmsOfDayApiHandler->handle(new GetTrendingFilmsOfDayQuery());
})->middleware('auth')->name('trending.by.day');
