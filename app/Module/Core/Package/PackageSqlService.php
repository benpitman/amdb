<?php

namespace App\Module\Core\Package;

use App\Module\Core\Entity\Database\Package\PackageDBEntity;
use App\Module\Core\Package\Repository\PackageRepository;

final class PackageSqlService
{
    public static function insertOne(PackageDBEntity $packageDBEntity): void
    {
        $packageRepository = new PackageRepository();

        $packageRepository->insertOne($packageDBEntity);
    }
}
