<?php

namespace App\Module\Core\Genre\Repository;

use Kentron\Template\ARepository;

final class GenreRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\Genre::class;
}
