<?php

namespace App\Module\Core\TitlePoster\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class TitlePosterCollectionEntity extends ACollectionEntity
{
    public function __construct()
    {
        parent::__construct(TitlePosterMapEntity::class);
    }
}
