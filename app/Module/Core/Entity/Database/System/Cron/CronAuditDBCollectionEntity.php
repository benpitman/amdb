<?php

namespace App\Module\Core\Entity\Database\System\Cron;

use Kentron\Entity\Template\ACoreCollectionEntity;

use App\Module\Core\Entity\Database\System\Cron\CronAuditDBEntity;
use App\Module\Core\System\Cron\Entity\CronAuditCollectionEntity;

final class CronAuditDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct ()
    {
        parent::__construct(new CronAuditCollectionEntity(), CronAuditDBEntity::class);
    }
}
