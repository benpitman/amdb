<?php

namespace App\Module\Core\Entity\Database\Genre;

use App\Module\Core\Genre\Entity\GenreCollectionEntity;
use Kentron\Entity\Template\ACoreCollectionEntity;

final class GenreDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct()
    {
        parent::__construct(new GenreCollectionEntity(), GenreDBEntity::class);
    }
}
