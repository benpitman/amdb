<?php

namespace App\Module\Core\Title;

use App\Module\Api\Entity\SearchEntity;
use App\Module\Core\Entity\Database\Title\TitleDBCollectionEntity;
use App\Module\Core\Entity\Database\Title\TitleDBEntity;
use App\Module\Core\Title\Repository\TitleRepository;
use App\Module\Core\Type\TypeSqlService;
use Illuminate\Database\Capsule\Manager;

final class TitleSqlService
{
    public static function search(SearchEntity $searchEntity): TitleDBCollectionEntity
    {
        $titleRepository = new TitleRepository();
        $titleDBCollectionEntity = new TitleDBCollectionEntity();

        $dateFrom = $searchEntity->getDTDateFrom();
        if (!is_null($dateFrom)) {
            $titleRepository->whereDateCreatedGreaterThan($dateFrom);
        }

        $dateTo = $searchEntity->getDTDateTo();
        if (!is_null($dateTo)) {
            $titleRepository->whereDateCreatedLessThan($dateTo);
        }

        foreach ($searchEntity->iterateQueries() as $query) {
            $titleRepository->whereTitle($query);
        }

        $titleTypeId = $searchEntity->getType();
        if (is_int($titleTypeId) && TypeSqlService::isValidId($titleTypeId)) {
            $titleRepository->whereType($titleTypeId);
        }

        $titleRepository->limit($searchEntity->getLimit());
        $titleRepository->offset($searchEntity->getOffset());

        $titleRepository->buildAll($titleDBCollectionEntity);

        return $titleDBCollectionEntity;
    }

    public static function bulkInsert(string $tsvPath): bool
    {
        return Manager::connection()->statement(
            "LOAD DATA LOCAL INFILE '$tsvPath' INTO TABLE `title` FIELDS TERMINATED BY '\\t' LINES TERMINATED BY '\\n'"
        );
    }

    public static function getOneByImdbId(string $imdbId): TitleDBEntity
    {
        $titleRepository = new TitleRepository();
        $titleDBEntity = new TitleDBEntity();

        $titleRepository->whereImdbId($imdbId);

        if (!$titleRepository->buildFirst($titleDBEntity)) {
            $titleDBEntity->addError("No title with IMDB constant '{$imdbId}' exists");
            return $titleDBEntity;
        }

        return $titleDBEntity;
    }
}
