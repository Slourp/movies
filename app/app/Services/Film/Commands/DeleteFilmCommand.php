<?php

namespace App\Services\Film\Commands;


class DeleteFilmCommand
{
    public function __construct(public readonly int $filmId)
    {
    }
}
