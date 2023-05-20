<?php

namespace App\Console\Commands;

use App\Services\Film\FilmApiInterface;
use Illuminate\Console\Command;

class urlCommandTest extends Command
{
    public function __construct(private FilmApiInterface $movieApi)
    {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:fire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        dd($this->movieApi->getTrendingFilmsOfMonth());
        dd([
            'url' => config('film-api.moviedb.url'),
            'token' => config('film-api.moviedb.token')
        ]);
    }
}
