<?php

namespace App\Services\Film\Commands\Handlers;

use App\Services\Film\Commands\CommandInterface;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $command);
}
