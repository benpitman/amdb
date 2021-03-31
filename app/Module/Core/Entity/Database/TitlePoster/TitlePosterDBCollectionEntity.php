<?php

namespace App\Module\Core\Entity\Database\TitlePoster;

use Kentron\Entity\Template\ACoreCollectionEntity;

use App\Module\Core\TitlePoster\Entity\TitlePosterCollectionEntity;

final class TitlePosterDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct()
    {
        parent::__construct(new TitlePosterCollectionEntity(), TitlePosterDBEntity::class);
    }
}
