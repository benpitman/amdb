<?php

namespace App\Module\Core\Entity\Database\Rating;

use Kentron\Entity\Template\ACoreCollectionEntity;

use App\Module\Core\Rating\Entity\RatingCollectionEntity;

final class RatingDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct()
    {
        parent::__construct(new RatingCollectionEntity(), RatingDBEntity::class);
    }
}
