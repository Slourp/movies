<?php

namespace App\Services\Film\Commands;


use App\DTOs\FilmDTO;

class AddFilmCommand
{
    public function __construct(public readonly FilmDTO $filmDTO)
    {
    }
}
