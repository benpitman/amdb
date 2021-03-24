<?php

namespace App\Module\Core\System\Cron\Entity;

use Kentron\Entity\Template\ACollectionEntity;

use App\Module\Core\System\Cron\Entity\CronMapEntity;

class CronCollectionEntity extends ACollectionEntity
{
    public function __construct ()
    {
        parent::__construct(CronMapEntity::class);
    }
}
