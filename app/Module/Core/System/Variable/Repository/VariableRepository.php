<?php

namespace App\Module\Core\System\Variable\Repository;

use Kentron\Template\ARepository;

class VariableRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\SystemVar::class;
}
