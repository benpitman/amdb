<?php

namespace App\Module\Core\Rating;

use Kentron\Template\ARepository;

final class RatingRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\Rating::class;
}
