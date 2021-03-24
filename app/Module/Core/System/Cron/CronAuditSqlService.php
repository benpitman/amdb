<?php

namespace App\Module\Core\System\Cron;

use App\Module\Core\System\Cron\Repository\CronAuditRepository;

use App\Module\Core\Entity\Database\System\Cron\CronAuditDBCollectionEntity;

final class CronAuditSqlService
{
    public static function insertMany (CronAuditDBCollectionEntity $cronAuditDBCollectionEntity)
    {
        $cronAuditRepository = new CronAuditRepository();
        $cronAuditRepository->insertMany($cronAuditDBCollectionEntity);
    }
}
