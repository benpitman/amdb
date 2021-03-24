<?php

namespace App\Module\Core\System\Cron\Template;

use App\Module\Core\System\Cron\Template\ACronController;

use App\Module\Core\System\Cron\Entity\CronMapEntity;

interface ICronFactory
{
    public static function getCronController (CronMapEntity $cronMapEntity): ACronController;
}
