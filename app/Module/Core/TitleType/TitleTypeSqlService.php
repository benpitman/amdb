<?php

namespace App\Module\Core\TitleType;

use App\Module\Core\Entity\Database\TitleType\TitleTypeDBCollectionEntity;
use App\Module\Core\TitleType\Repsository\TitleTypeRepository;

final class TitleTypeSqlService
{
    public static function getAll(): TitleTypeDBCollectionEntity
    {
        $titleTypeDBCollectionEntity = new TitleTypeDBCollectionEntity();
        $titleTypeRepository = new TitleTypeRepository();

        $titleTypeRepository->buildAll($titleTypeDBCollectionEntity);

        return $titleTypeDBCollectionEntity;
    }
}
