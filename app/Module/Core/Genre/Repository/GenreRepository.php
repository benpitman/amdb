<?php

namespace App\Module\Core\Genre\Repsository;

use Kentron\Template\ARepository;

final class GenreRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\Genre::class;
}
