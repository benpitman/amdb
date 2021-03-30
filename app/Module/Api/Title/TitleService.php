<?php

namespace App\Module\Api\Title;

use App\Module\Api\Entity\Title\TitleApiCollectionEntity;
use App\Module\Api\Entity\SearchEntity;
use App\Module\Api\Entity\SearchResponseEntity;
use App\Module\Api\Entity\Title\TitleApiEntity;
use App\Module\Core\Title\TitleSqlService;

final class TitleService
{
    public static function search(SearchEntity $searchEntity): SearchResponseEntity
    {
        $responseSearchEntity = new SearchResponseEntity();
        $titleApiCollectionEntity = new TitleApiCollectionEntity();

        $titleDBCollectionEntity = TitleSqlService::search($searchEntity);

        foreach ($titleDBCollectionEntity->iterateEntities() as $titleMapEntity) {
            $titleApiEntity = new TitleApiEntity($titleMapEntity);

            $titleApiCollectionEntity->addEntity($titleApiEntity);
        }

        $responseSearchEntity->setTitleApiCollectionEntity($titleApiCollectionEntity);

        return $responseSearchEntity;
    }
}
