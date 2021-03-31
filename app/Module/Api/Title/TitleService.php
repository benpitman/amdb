<?php

namespace App\Module\Api\Title;

use App\Module\Api\Entity\Title\TitleApiCollectionEntity;
use App\Module\Api\Entity\SearchEntity;
use App\Module\Api\Entity\SearchResponseEntity;
use App\Module\Api\Entity\Title\TitleApiEntity;
use App\Module\Core\Title\TitleSqlService;
use App\Module\Core\TitleGenre\TitleGenreSqlService;
use App\Module\Core\Title\Entity\TitleMapEntity;
use App\Module\Core\TitleDescription\TitleDescriptionSqlService;
use App\Module\Core\TitleGenre\Entity\TitleGenreCollectionEntity;
use App\Module\Core\TitleDescription\Entity\TitleDescriptionMapEntity;
use App\Module\Core\Type\TypeSqlService;
use App\Module\Core\Type\Entity\TypeMapEntity;

final class TitleService
{
    public static function search(SearchEntity $searchEntity): SearchResponseEntity
    {
        $responseSearchEntity = new SearchResponseEntity();
        $titleApiCollectionEntity = new TitleApiCollectionEntity();

        $titleDBCollectionEntity = TitleSqlService::search($searchEntity);

        /** @var TitleMapEntity */
        foreach ($titleDBCollectionEntity->iterateEntities() as $titleMapEntity) {
            /** @var TitleGenreCollectionEntity */
            $titleGenreCollectionEntity = TitleGenreSqlService::getAllByImdbId($titleMapEntity->getImdbId())->getRootEntity();

            if ($titleGenreCollectionEntity->hasEntities()) {
                $titleMapEntity->setTitleGenreCollectionEntity($titleGenreCollectionEntity);
            }

            /** @var TypeMapEntity */
            $typeMapEntity = TypeSqlService::getOneById($titleMapEntity->getTypeId())->getRootEntity();

            $titleMapEntity->setTypeMapEntity($typeMapEntity);

            $titleApiCollectionEntity->addEntity(
                $titleApiCollectionEntity->getNewCoreEntity($titleMapEntity)
            );
        }

        $responseSearchEntity->setTitleApiCollectionEntity($titleApiCollectionEntity);

        return $responseSearchEntity;
    }

    public static function get(string $imdbId): TitleApiEntity
    {
        $titleDBEntity = TitleSqlService::getOneByImdbId($imdbId);

        if ($titleDBEntity->hasErrors()) {
            $titleApiEntity = new TitleApiEntity();

            $titleApiEntity->mergeAlerts($titleDBEntity);
            return $titleApiEntity;
        }

        /** @var TitleMapEntity|TitleApiEntity */
        $titleApiEntity = new TitleApiEntity($titleDBEntity->getRootEntity());

        /** @var TitleDescriptionMapEntity */
        $titleDescriptionMapEntity = TitleDescriptionSqlService::getOneByImdbId($titleApiEntity->getImdbId())->getRootEntity();
        $titleApiEntity->setTitleDescriptionMapEntity($titleDescriptionMapEntity);

        return $titleApiEntity;
    }
}
