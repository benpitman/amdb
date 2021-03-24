<?php

namespace App\Module\System\Entity\Permission;

use App\Module\System\Permission\Entity\PermissionMapCollectionEntity;
use Kentron\Entity\Template\ACoreCollectionEntity;

final class PermissionSystemCollectionEntity extends ACoreCollectionEntity
{
    public function __construct (PermissionMapCollectionEntity $permissionMapCollectionEntity)
    {
        parent::__construct($permissionMapCollectionEntity);
    }

    public function normalise (): array
    {
        $map = [];

        foreach ($this->map(["getConstant", "getBit"]) as [$constant, $bit]) {
            $map[$constant] = $bit;
        }

        return $map;
    }
}
