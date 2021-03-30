<?php

namespace App\Module\Core\Imdb;

use App\Core\Service\Error;
use App\Core\Store\Imdb;
use App\Module\Core\Entity\Database\Poster\PosterDBEntity;
use App\Module\Core\Imdb\Entity\ImdbEntity;
use Kentron\Service\File;
use App\Module\Core\Imdb\Template\ADataset;
use App\Module\Core\Poster\Entity\PosterMapEntity;
use App\Module\Core\Title\TitleSqlService;

final class ImdbService
{
    public function downloadPackage(ADataset $dataset): ImdbEntity
    {
        $imdbEntity = new ImdbEntity();

        $dataset->download();

        if ($dataset->hasErrors()) {
            $imdbEntity->mergeAlerts($dataset);
        }

        return $imdbEntity;
    }

    public function cacheInfo(string $imdbId): ImdbEntity
    {
        $imdbEntity = new ImdbEntity();
        $dump = File::get(Imdb::TITLE_URL . $imdbId);

        if (is_null($dump)) {
            $imdbEntity->addError("Failed to get web data from IMDB");
            return $imdbEntity;
        }

        if (!$this->cachePosters($imdbId, $dump)) {
            Error::save("Failed to cache poster for {$imdbId}");
            $imdbEntity->addError("Failed to cache poster");
        }

        if (!$this->cacheDescription($imdbId, $dump)) {
            Error::save("Failed to cache description for {$imdbId}");
            $imdbEntity->addError("Failed to cache description");
        }

        return $imdbEntity;
    }

    /**
     * Private methods
     */

    private function cachePosters(int $imdbId, string $dump): bool
    {
        $matches = [];
        preg_match('/og:image.+?content="\K[^"]+/', $dump, $matches);

        if (empty($matches)) {
            return false;
        }

        $smallCover = $matches[0];
        $fullCover = preg_replace('/(.=?\._V1_).+(.\w{3})$/', '$1$2', $smallCover);

        if (is_string($smallCover) || is_string($fullCover)) {

            /** @var PosterMapEntity|PosterDBEntity */
            $posterDBEntity = new PosterDBEntity();

            $posterDBEntity->setImdbId($imdbId);
            $posterDBEntity->setSmall($smallCover);
            $posterDBEntity->setFull($fullCover);
        }

        return true;
    }

    private function cacheDescription(int $imdbId, string $dump): bool
    {
        $matches = [];
        preg_match('/og:description.+?content="\K[^"]+/', $dump, $matches);

        if (empty($matches)) {
            return false;
        }

        $description = $matches[0] ?? null;

        if (is_string($description)) {
            TitleSqlService::updateDescription(
                $imdbId,
                $description
            );
        }

        return true;
    }
}
