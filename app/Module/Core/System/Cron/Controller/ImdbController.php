<?php

namespace App\Module\Core\System\Cron\Controller;

use App\Module\Core\Imdb\Dataset\Rating;
use App\Module\Core\System\Cron\Template\ACronController;

use App\Module\Core\Imdb\Dataset\Title;
use App\Module\Core\Imdb\Entity\ImdbEntity;
use App\Module\Core\Imdb\ImdbService;

final class ImdbController extends ACronController
{
    public function downloadTitleDataset(): ImdbEntity
    {
        return $this->getImdbService()->downloadPackage(new Title());
    }

    public function downloadRatingDataset(): ImdbEntity
    {
        return $this->getImdbService()->downloadPackage(new Rating());
    }

    // public function downloadEpisodeDataset(): ImdbEntity
    // {
    //     return $this->getImdbService()->downloadPackage(new Episode());
    // }

    private function getImdbService(): ImdbService
    {
        return new ImdbService();
    }
}
