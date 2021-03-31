<?php

namespace App\Module\Core\Entity\Database\TitleGenre;

use App\Module\Core\TitleGenre\Entity\TitleGenreCollectionEntity;
use Kentron\Entity\Template\ACoreCollectionEntity;

final class TitleGenreDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct()
    {
        parent::__construct(new TitleGenreCollectionEntity(), TitleGenreDBEntity::class);
    }
}
