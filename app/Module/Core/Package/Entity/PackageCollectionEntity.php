<?php

namespace App\Module\Core\Package\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class PackageCollectionEntity extends ACollectionEntity
{
    public function __construct()
    {
        parent::__construct(PackageMapEntity::class);
    }
}
