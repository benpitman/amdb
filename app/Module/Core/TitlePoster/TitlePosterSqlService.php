<?php

namespace App\Module\Core\TitlePoster;

use App\Module\Core\Entity\Database\TitlePoster\TitlePosterDBEntity;

final class TitlePosterSqlService
{
    public static function insertOne(TitlePosterDBEntity $posterDBEntity): void
    {
        $posterRepository = new TitlePosterRepository();

        $posterRepository->insertOne($posterDBEntity);
    }
}
