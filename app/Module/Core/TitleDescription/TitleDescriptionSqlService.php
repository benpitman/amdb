<?php

namespace App\Module\Core\TitleDescription;

use App\Module\Core\Entity\Database\TitleDescription\TitleDescriptionDBEntity;
use App\Module\Core\TitleDescription\Repository\TitleDescriptionRepository;

final class TitleDescriptionSqlService
{
    public static function insertOne(TitleDescriptionDBEntity $titleDescriptionDBEntity): void
    {
        $titleDescriptionRepository = new TitleDescriptionRepository();

        $titleDescriptionRepository->insertOne($titleDescriptionDBEntity);
    }

    public static function getOneByImdbId(string $imdbId): TitleDescriptionDBEntity
    {
        $titleDescriptionRepository = new TitleDescriptionRepository();
        $titleDescriptionDBEntity = new TitleDescriptionDBEntity();

        $titleDescriptionRepository->whereImdbId($imdbId);

        $titleDescriptionRepository->buildFirst($titleDescriptionDBEntity);

        return $titleDescriptionDBEntity;
    }
}
