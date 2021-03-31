<?php

namespace App\Module\Core\Imdb;

use App\Core\Service\Error;
use App\Core\Store\Imdb;
use App\Module\Core\Entity\Database\TitleDescription\TitleDescriptionDBEntity;
use App\Module\Core\Entity\Database\TitlePoster\TitlePosterDBEntity;
use App\Module\Core\Imdb\Entity\ImdbEntity;
use Kentron\Service\File;
use App\Module\Core\Imdb\Template\ADataset;
use App\Module\Core\TitlePoster\Entity\TitlePosterMapEntity;
use App\Module\Core\TitleDescription\Entity\TitleDescriptionMapEntity;
use App\Module\Core\TitleDescription\TitleDescriptionSqlService;
use App\Module\Core\TitlePoster\TitlePosterSqlService;

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

        /** @var string|null */
        $smallCover = $matches[0] ?? null;
        /** @var string|null */
        $fullCover = preg_replace('/(.=?\._V1_).+(.\w{3})$/', '$1$2', $smallCover) ?: null;

        /** @var TitlePosterMapEntity|TitlePosterDBEntity */
        $titlePosterDBEntity = new TitlePosterDBEntity();

        $titlePosterDBEntity->setImdbId($imdbId);
        $titlePosterDBEntity->setSmall($smallCover);
        $titlePosterDBEntity->setFull($fullCover);

        TitlePosterSqlService::insertOne($titlePosterDBEntity);

        return true;
    }

    private function cacheDescription(int $imdbId, string $dump): bool
    {
        $matches = [];
        preg_match('/og:description.+?content="\K[^"]+/', $dump, $matches);

        if (empty($matches)) {
            return false;
        }

        /** @var TitleDescriptionMapEntity|TitleDescriptionDBEntity */
        $titleDescriptionDBEntity = new TitleDescriptionDBEntity();

        $titleDescriptionDBEntity->setImdbId($imdbId);
        $titleDescriptionDBEntity->setText($matches[0] ?? null);

        TitleDescriptionSqlService::insertOne($titleDescriptionDBEntity);

        return true;
    }
}
