<?php

namespace App\Services\Film\Commands;


use App\DTOs\FilmDTO;

class AddFilmCommand implements CommandInterface
{
    public function __construct(public readonly FilmDTO $filmDTO)
    {
    }
}
