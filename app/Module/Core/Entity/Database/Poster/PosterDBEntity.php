<?php

namespace App\Module\Core\Entity\Database\Poster;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\Poster\Entity\PosterMapEntity;

final class PosterDBEntity extends ADBEntity
{
    public function __construct()
    {
        parent::__construct(new PosterMapEntity());
    }
}
