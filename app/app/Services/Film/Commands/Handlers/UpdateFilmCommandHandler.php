<?php

namespace App\Services\Film\Commands\Handlers;

use App\Models\Film;
use App\Services\Film\Commands\CommandInterface;

class UpdateFilmCommandHandler implements CommandHandlerInterface
{
    public function handle(CommandInterface $command)
    {
        /**
         * @var UpdateFilmCommand $command
         */

        $filmDTO = $command->filmDTO;

        $film = Film::findOrFail($filmDTO->id);
        $fillableFields = array_diff($film->getFillable(), ['id']);
        $film->fill((array) $filmDTO, $fillableFields);
        $film->save();

        return;
    }
}
