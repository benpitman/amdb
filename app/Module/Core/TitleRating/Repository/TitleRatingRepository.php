<?php

namespace App\Module\Core\TitleRating;

use Kentron\Template\ARepository;

final class TitleRatingRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\TitleRating::class;
}
