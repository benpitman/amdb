<?php

namespace App\Module\Core\Title\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class TitleCollectionEntity extends ACollectionEntity
{
    public function __construct()
    {
        parent::__construct(TitleMapEntity::class);
    }
}
