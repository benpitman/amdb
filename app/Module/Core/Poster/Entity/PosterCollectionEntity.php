<?php

namespace App\Module\Core\Poster\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class PosterCollectionEntity extends ACollectionEntity
{
    public function __construct()
    {
        parent::__construct(PosterMapEntity::class);
    }
}
