<?php


use App\Models\Film;
use App\Services\Film\Commands\CommandInterface;
use App\Services\Film\Commands\Handlers\CommandHandlerInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteFilmCommandHandler implements CommandHandlerInterface
{
    public function handle(CommandInterface $command)
    {
        try {
            $film = Film::findOrFail($command->filmId);
            $film->delete();
        } catch (ModelNotFoundException $exception) {
            throw new \Exception("Film not found");
        }

        return;
    }
}
