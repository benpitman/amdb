<?php

namespace App\Module\Core\TitleType\Repository;

use Kentron\Template\ARepository;

final class TitleTypeRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\TitleType::class;
}
