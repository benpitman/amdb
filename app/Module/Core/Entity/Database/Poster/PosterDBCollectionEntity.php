<?php

namespace App\Module\Core\Entity\Database\Poster;

use Kentron\Entity\Template\ACoreCollectionEntity;

use App\Module\Core\Poster\Entity\PosterCollectionEntity;

final class PosterDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct()
    {
        parent::__construct(new PosterCollectionEntity(), PosterDBEntity::class);
    }
}
