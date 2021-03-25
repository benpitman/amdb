<?php

namespace App\Module\Core\Imdb;

use App\Core\Service\Error;
use App\Core\Store\Imdb;
use App\Module\Core\Entity\Database\Package\PackageDBCollectionEntity;
use App\Module\Core\Imdb\Entity\ImdbEntity;
use App\Module\Core\Package\Entity\PackageMapEntity;
use App\Module\Core\Title\TitleSqlService;
use Kentron\Service\File;

final class ImdbService
{
    public function downloadPackages(PackageDBCollectionEntity $packageDBCollectionEntity): ImdbEntity
    {
        $rootImdbEntity = new ImdbEntity();

        /** @var PackageMapEntity */
        foreach ($packageDBCollectionEntity->iterateEntities() as $packageMapEntity) {
            $imdbEntity = $this->downloadPackage($packageMapEntity);

            if ($imdbEntity->hasErrors()) {
                $rootImdbEntity->mergeAlerts($imdbEntity);
                break;
            }
        }

        return $rootImdbEntity;
    }

    public function downloadPackage(PackageMapEntity $packageMapEntity): ImdbEntity
    {
        $imdbEntity = new ImdbEntity();
        $datasetClass = $packageMapEntity->getNewClass();

        if (!$datasetClass->run()) {
            $imdbEntity->mergeAlerts($datasetClass);
        }

        TitleSqlService::bulkInsert($datasetClass->getTsvPath());

        return $imdbEntity;
    }

    public function cacheInfo(string $imdbId): void
    {
        $dump = File::get(Imdb::TITLE_URL . $imdbId);

        if (is_null($dump)) {
            return;
        }

        if (!$this->cachePosters($dump)) {
            Error::save("Failed to cache poster for {$imdbId}");
        }
        if (!$this->cacheDescription($dump)) {
            Error::save("Failed to cache description for {$imdbId}");
        }
    }

    /**
     * Private methods
     */

    private function cachePosters(string $dump): bool
    {
        preg_match('/og:image.+?content="\K[^"]+/', $dump, $matches);

        if (empty($matches)) {
            return false;
        }

        $smallCover = $matches[0];
        $fullCover = preg_replace('/(.=?\._V1_).+(.\w{3})$/', '$1$2', $smallCover);

        return true;
    }

    private function cacheDescription(string $dump): bool
    {
        preg_match('/og:description.+?content="\K[^"]+/', $dump, $matches);

        if (empty($matches)) {
            return false;
        }

        $description = $matches[0];

        return true;
    }
}
