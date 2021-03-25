<?php

namespace App\Module\Core\Entity\Database\Package;

use Kentron\Entity\Template\ACoreCollectionEntity;

use App\Module\Core\Package\Entity\PackageCollectionEntity;

final class PackageDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct()
    {
        parent::__construct(new PackageCollectionEntity(), PackageDBEntity::class);
    }
}
