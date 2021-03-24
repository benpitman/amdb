<?php

namespace App\Module\System\Permission\Repository;

use Kentron\Template\ARepository;

final class PermissionRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\Permission::class;
}
