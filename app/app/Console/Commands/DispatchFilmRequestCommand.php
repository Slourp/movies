<?php

namespace App\Console\Commands;

use App\Jobs\FilmJobDispatcher;
use App\Jobs\ProcessFilmRequestJob;
use App\Services\Film\Commands\Handlers\AddFilmCommandHandler;
use App\Services\Film\FilmApiInterface;
use App\Services\Film\Queries\Handlers\GetTrendingFilmsOfDayApiHandler;
use Illuminate\Console\Command;

class DispatchFilmRequestCommand extends Command
{
    public function __construct(
        private GetTrendingFilmsOfDayApiHandler $getTrendingFilmsOfDayApiHandler,
        private AddFilmCommandHandler $addFilmCommandHandler,
        private FilmApiInterface $api

    ) {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'film:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch film request job';

    /**
     * Execute the console command.²
     */
    public function handle()
    {
        // Dispatch the job
        $filmJobDispatcher = new FilmJobDispatcher(
            $this->getTrendingFilmsOfDayApiHandler,
            $this->addFilmCommandHandler,
            $this->api
        );
        $filmJobDispatcher->dispatchFilmJobs();
        $this->info('Film request job dispatched.');
    }
}
