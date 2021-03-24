<?php

namespace App\Module\System\Entity\Database\Permission;

use App\Module\System\Permission\Entity\PermissionMapCollectionEntity;
use Kentron\Entity\Template\ACoreCollectionEntity;

final class PermissionDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct ()
    {
        parent::__construct(new PermissionMapCollectionEntity(), PermissionDBEntity::class);
    }
}
