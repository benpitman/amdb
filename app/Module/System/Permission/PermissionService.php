<?php

namespace App\Module\System\Permission;

use App\Module\System\Entity\Permission\PermissionSystemCollectionEntity;

final class PermissionService
{
    public function getAll (): PermissionSystemCollectionEntity
    {
        $permissionSystemCollectionEntity = new PermissionSystemCollectionEntity(
            PermissionSqlService::getAll()->getRootEntity()
        );

        return $permissionSystemCollectionEntity;
    }
}
