<?php

namespace App\Module\Core\System\Cron\Template;

use App\Module\Core\System\Cron\Entity\CronEntity;

abstract class ACronController
{
    protected $cronEntity;

    final public function setCronEntity (CronEntity $cronEntity): void
    {
        $this->cronEntity = $cronEntity;
    }
}
