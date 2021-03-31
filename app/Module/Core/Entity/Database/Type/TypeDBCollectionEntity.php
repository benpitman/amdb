<?php

namespace App\Module\Core\Entity\Database\Type;

use App\Module\Core\Type\Entity\TypeCollectionEntity;
use Kentron\Entity\Template\ACoreCollectionEntity;

final class TypeDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct()
    {
        parent::__construct(new TypeCollectionEntity(), TypeDBEntity::class);
    }
}
