<?php

namespace App\Module\Api\Entity\Title;

use Kentron\Entity\Template\ACoreCollectionEntity;

use App\Module\Core\Title\Entity\TitleCollectionEntity;

final class TitleApiCollectionEntity extends ACoreCollectionEntity
{
    public function __construct()
    {
        parent::__construct(new TitleCollectionEntity(), TitleApiEntity::class);
    }
}
