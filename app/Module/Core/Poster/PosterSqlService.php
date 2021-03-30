<?php

namespace App\Module\Core\Poster;

use App\Module\Core\Entity\Database\Poster\PosterDBEntity;

final class PosterSqlService
{
    public static function insertOne(PosterDBEntity $posterDBEntity): void
    {
        $posterRepository = new PosterRepository();

        $posterRepository->insertOne($posterDBEntity);
    }
}
