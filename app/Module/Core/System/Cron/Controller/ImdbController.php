<?php

namespace App\Module\Core\System\Cron\Controller;

use App\Module\Core\Imdb\Dataset\Rating;
use App\Module\Core\System\Cron\Template\ACronController;

use App\Module\Core\Imdb\Dataset\Title;
use App\Module\Core\Imdb\Entity\ImdbEntity;
use App\Module\Core\Imdb\ImdbService;

final class ImdbController extends ACronController
{
    public function downloadTitleDataset(): ?ImdbEntity
    {
        $ratingEntity = $this->getImdbService()->downloadPackage(new Rating());

        if ($ratingEntity->hasErrors()) {
            return $ratingEntity;
        }

        $titleEntity = $this->getImdbService()->downloadPackage(new Title());

        if ($titleEntity->hasErrors()) {
            return $titleEntity;
        }

        return null;
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
