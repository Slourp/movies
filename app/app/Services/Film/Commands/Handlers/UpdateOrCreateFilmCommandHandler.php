<?

namespace App\Services\Film\Commands\Handlers;

use App\Models\Film;
use App\Services\Film\Commands\CommandInterface;

class UpdateOrCreateFilmCommandHandler implements CommandHandlerInterface
{
    public function handle(CommandInterface $command)
    {
        /**
         * @var UpdateFilmCommand $command
         */

        $filmDTO = $command->filmDTO;

        Film::updateOrCreate(['id' => $filmDTO->id], (array) $filmDTO);

        return;
    }
}
