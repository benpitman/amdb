<?php

namespace App\Module\Core\Type;

use App\Module\Core\Entity\Database\Type\TypeDBCollectionEntity;
use App\Module\Core\Entity\Database\Type\TypeDBEntity;
use App\Module\Core\Type\Repository\TypeRepository;

final class TypeSqlService
{
    public static function getAll(): TypeDBCollectionEntity
    {
        $typeDBCollectionEntity = new TypeDBCollectionEntity();
        $typeRepository = new TypeRepository();

        $typeRepository->buildAll($typeDBCollectionEntity);

        return $typeDBCollectionEntity;
    }

    public static function isValidId(int $typeId): bool
    {
        $typeRepository = new TypeRepository();

        $typeRepository->whereId($typeId);

        return !!$typeRepository->first();
    }

    public static function getOneById(int $typeId): TypeDBEntity
    {
        $typeRepository = new TypeRepository();
        $typeDBEntity = new TypeDBEntity();

        $typeRepository->whereId($typeId);

        $typeRepository->buildFirst($typeDBEntity);

        return $typeDBEntity;
    }
}
