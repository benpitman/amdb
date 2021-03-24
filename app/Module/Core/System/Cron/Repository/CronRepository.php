<?php

namespace App\Module\Core\System\Cron\Repository;

use Kentron\Template\ARepository;

final class CronRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\SystemCron::class;

    public function whereID (int $cronID): void
    {
        parent::where("system_cron_id", $cronID);
    }

    public function updateDateRan (string $dateRan): void
    {
        $this->addUpdate("system_cron_date_ran", $dateRan);
    }
}
