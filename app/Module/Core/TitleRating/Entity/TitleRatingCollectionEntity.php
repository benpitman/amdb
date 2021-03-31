<?php

namespace App\Module\Core\TitleRating\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class TitleRatingCollectionEntity extends ACollectionEntity
{
    public function __construct()
    {
        parent::__construct(TitleRatingMapEntity::class);
    }
}
