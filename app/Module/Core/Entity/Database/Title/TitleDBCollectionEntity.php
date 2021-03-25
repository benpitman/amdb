<?php

namespace App\Module\Core\Entity\Database\Title;

use App\Module\Core\Title\Entity\TitleCollectionEntity;
use Kentron\Entity\Template\ACoreCollectionEntity;

final class TitleDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct()
    {
        parent::__construct(new TitleCollectionEntity(), TitleDBEntity::class);
    }
}
