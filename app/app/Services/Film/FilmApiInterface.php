<?php

namespace App\Services\Film;



interface FilmApiInterface
{
    /**
     * Get the trending films of the day.
     *
     * @return array|null
     */
    public function getTrendingFilmsOfDay(): ?array;

    /**
     * Get the trending films of the month.
     *
     * @return array|null
     */
    public function getTrendingFilmsOfMonth(): ?array;

    /**
     * Get the details of a film.
     *
     * @param int $filmId
     * @return array|null
     */
    public function getFilmDetails(int $filmId): ?array;
}
