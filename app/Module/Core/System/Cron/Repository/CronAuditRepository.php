<?php

namespace App\Module\Core\System\Cron\Repository;

use Kentron\Template\ARepository;

final class CronAuditRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\SystemCronAudit::class;
}
