<?php

namespace App\Module\Core\Rating\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class RatingCollectionEntity extends ACollectionEntity
{
    public function __construct()
    {
        parent::__construct(RatingMapEntity::class);
    }
}
