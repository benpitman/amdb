<?php

namespace App\Core\Console\Command\Session;

use App\Module\Core\Imdb\ImdbService;
use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class DownloadCommand extends Command
{
    public function configure ()
    {
        $this->setName("destory_expired_session");
        $this->setDescription("Destroys any sessions for the external reference under the session ID given");
    }

    public function execute (InputInterface $inputInterface, OutputInterface $outputInterface): void
    {
        $imdbService = new ImdbService();
    }
}
