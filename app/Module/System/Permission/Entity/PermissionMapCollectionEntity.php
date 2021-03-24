<?php

namespace App\Module\System\Permission\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class PermissionMapCollectionEntity extends ACollectionEntity
{
    public function __construct ()
    {
        parent::__construct(PermissionMapEntity::class);
    }
}
