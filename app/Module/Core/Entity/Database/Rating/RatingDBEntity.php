<?php

namespace App\Module\Core\Entity\Database\Rating;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\Rating\Entity\RatingMapEntity;

final class RatingDBEntity extends ADBEntity
{
    public function __construct()
    {
        parent::__construct(new RatingMapEntity());
    }
}
