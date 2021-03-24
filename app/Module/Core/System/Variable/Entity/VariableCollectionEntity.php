<?php

namespace App\Module\Core\System\Variable\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class VariableCollectionEntity extends ACollectionEntity
{
    public function __construct ()
    {
        parent::__construct(VariableMapEntity::class);
    }
}
