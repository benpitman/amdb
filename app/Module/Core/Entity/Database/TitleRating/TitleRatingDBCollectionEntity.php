<?php

namespace App\Module\Core\Entity\Database\TitleRating;

use Kentron\Entity\Template\ACoreCollectionEntity;

use App\Module\Core\TitleRating\Entity\TitleRatingCollectionEntity;

final class TitleRatingDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct()
    {
        parent::__construct(new TitleRatingCollectionEntity(), TitleRatingDBEntity::class);
    }
}
