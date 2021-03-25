<?php

namespace App\Module\Core\Package\Repository;

use Kentron\Template\ARepository;

final class PackageRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\Package::class;
}
