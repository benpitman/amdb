<?php

namespace App\Module\Core\System\Error\Repository;

use Kentron\Template\ARepository;

final class ErrorRepository extends ARepository
{
    protected $ormModel = \App\Core\Model\SystemError::class;
}
