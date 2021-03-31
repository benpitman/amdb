<?php

namespace App\Module\Core\TitleGenre\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class TitleGenreCollectionEntity extends ACollectionEntity
{
    public function __construct()
    {
        parent::__construct(TitleGenreMapEntity::class);
    }
}
