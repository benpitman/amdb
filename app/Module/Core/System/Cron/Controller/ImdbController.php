<?php

namespace App\Module\Core\System\Cron\Controller;

use App\Module\Core\Imdb\Dataset\Rating;
use App\Module\Core\System\Cron\Template\ACronController;

use App\Module\Core\Imdb\Dataset\Title;
use App\Module\Core\Imdb\Entity\ImdbEntity;
use App\Module\Core\Imdb\ImdbService;

final class ImdbController extends ACronController
{
    public function updatePackages(): ?ImdbEntity
    {
        // TODO: create truncate

        $imdbService = new ImdbService();
        $titleEntity = $imdbService->downloadPackage(new Title());

        if ($titleEntity->hasErrors()) {
            return $titleEntity;
        }

        $ratingEntity = $imdbService->downloadPackage(new Rating());

        if ($ratingEntity->hasErrors()) {
            return $ratingEntity;
        }

        // $episodeEntity = $imdbService->downloadPackage(new Episode());

        // if ($episodeEntity->hasErrors()) {
        //     return $episodeEntity;
        // }

        return null;
    }
}
