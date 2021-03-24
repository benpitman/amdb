<?php

namespace App\Module\Core\System\Cron\Entity;

use Kentron\Entity\Template\ACollectionEntity;

use App\Module\Core\System\Cron\Entity\CronAuditMapEntity;

final class CronAuditCollectionEntity extends ACollectionEntity
{
    public function __construct ()
    {
        parent::__construct(CronAuditMapEntity::class);
    }
}
