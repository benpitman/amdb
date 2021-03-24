<?php

namespace App\Module\Core\System\Cron\Factory;

use App\Module\Core\System\Cron\Template\{ICronFactory, ACronController};

use App\Module\Core\System\Cron\Entity\CronMapEntity;

final class CronFactory implements ICronFactory
{
    public static function getCronController (CronMapEntity $cronMapEntity): ACronController
    {
        $methodName = "get" . $cronMapEntity->getClass() . "Controller";

        return self::$methodName();
    }
}
