<?php

namespace App\Core\Console;

use Symfony\Component\Console\Application as SymfonyApplication;

final class ConsoleService extends SymfonyApplication
{
    public function __construct ()
    {
        $this->registerCommands();
        parent::__construct();
    }

    private function registerCommands (): void
    {

    }
}
