<?php

namespace App\Module\Core\Poster;

use Kentron\Template\ARepository;

final class PosterRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\Poster::class;
}
