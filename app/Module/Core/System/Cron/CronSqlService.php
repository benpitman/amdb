<?php

namespace App\Module\Core\System\Cron;

use Kentron\Facade\DT;
use App\Module\Core\System\Cron\Repository\CronRepository;

use App\Module\Core\Entity\Database\System\Cron\CronDBCollectionEntity;

final class CronSqlService
{
    public static function getActive (): CronDBCollectionEntity
    {
        $cronDBCollectionEntity = new CronDBCollectionEntity();
        $cronRepository = new CronRepository();

        $cronRepository->buildAll($cronDBCollectionEntity);

        return $cronDBCollectionEntity;
    }

    public static function updateDateRan (int $cronID): void
    {
        $cronRepository = new CronRepository();

        $cronRepository->whereID($cronID);
        $cronRepository->updateDateRan(DT::now()->format());

        $cronRepository->runUpdate();
    }
}
