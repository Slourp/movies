<?php

namespace App\Services\Film\Commands\Handlers;

use App\Models\Film;
use App\Services\Film\Commands\AddFilmCommand;
use App\Services\Film\Commands\CommandInterface;

class AddFilmCommandHandler implements CommandHandlerInterface
{

    public function handle(CommandInterface $command)
    {
        /**
         * @var AddFilmCommand $command
         */

        $filmDTO = $command->filmDTO;

        Film::firstOrCreate(['id' => $command->filmDTO->id], (array) $filmDTO);

        return;
    }
}
