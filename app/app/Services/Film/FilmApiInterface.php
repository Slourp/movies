<?php

namespace App\Services\Film;

interface FilmApiInterface
{
    /**
     * Get the trending films of the day.
     *
     * @param int $page
     * @return array|null
     */
    public function getTrendingFilmsOfDay(int $page = 1): ?array;

    /**
     * Get the trending films of the month.
     *
     * @param int $page
     * @return array|null
     */
    public function getTrendingFilmsOfMonth(int $page = 1): ?array;

    /**
     * Get the details of a film.
     *
     * @param int $filmId
     * @return array|null
     */
    public function getFilmDetails(int $filmId): ?array;

    /**
     * Search for a specific film.
     *
     * @param int $filmId
     * @return array|null
     */
    /**
     * Search films.
     *
     * @param string $query
     * @param int $page
     * @return array|null
     */
    public function searchFilms(string $query, ?int $page = 1): ?array;
}
