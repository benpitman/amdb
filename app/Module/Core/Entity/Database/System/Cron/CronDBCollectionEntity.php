<?php

namespace App\Module\Core\Entity\Database\System\Cron;

use Kentron\Entity\Template\ACoreCollectionEntity;

use App\Module\Core\Entity\Database\System\Cron\CronDBEntity;
use App\Module\Core\System\Cron\Entity\CronCollectionEntity;

final class CronDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct ()
    {
        parent::__construct(new CronCollectionEntity(), CronDBEntity::class);
    }
}
