<?php

use App\Http\Livewire\Films;
use App\Http\Livewire\TrendingMovies;
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


Route::get('films', Films::class)->middleware('auth')->name('films');

Route::get('trendeing-by-month', TrendingMovies::class)
    ->middleware('auth')
    ->name('trending.by.month');
