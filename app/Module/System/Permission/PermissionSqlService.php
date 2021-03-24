<?php

namespace App\Module\System\Permission;

use App\Module\System\Entity\Database\Permission\PermissionDBCollectionEntity;
use App\Module\System\Permission\Repository\PermissionRepository;

final class PermissionSqlService
{
    public static function getAll (): PermissionDBCollectionEntity
    {
        $permissionRepository = new PermissionRepository();
        $permissionDBCollectionEntity = new PermissionDBCollectionEntity();

        $permissionRepository->buildAll($permissionDBCollectionEntity);

        return $permissionDBCollectionEntity;
    }
}
