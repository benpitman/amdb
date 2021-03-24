<?php

namespace App\Module\Core\Entity\Database\System\Variable;

use Kentron\Entity\Template\ACoreCollectionEntity;

use App\Module\Core\System\Variable\Entity\VariableCollectionEntity;

final class VariableDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct ()
    {
        parent::__construct(new VariableCollectionEntity(), VariableDBEntity::class);
    }
}
