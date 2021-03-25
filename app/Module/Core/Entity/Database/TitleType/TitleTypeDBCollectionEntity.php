<?php

namespace App\Module\Core\Entity\Database\TitleType;

use App\Module\Core\TitleType\Entity\TitleTypeCollectionEntity;
use Kentron\Entity\Template\ACoreCollectionEntity;

final class TitleTypeDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct()
    {
        parent::__construct(new TitleTypeCollectionEntity(), TitleTypeDBEntity::class);
    }
}
