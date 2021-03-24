<?php

namespace App\Module\Core\Entity\Database\System\Cron;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\System\Cron\Entity\CronAuditMapEntity;

final class CronAuditDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "system_cron_audit_id";
    protected $dateCreatedColumn = "system_cron_audit_date_created";

    protected $propertyMap = [
        "system_cron_audit_cron_id" => [
            "get" => "getCronID",
            "set" => "setCronID"
        ],
        "system_cron_audit_successful" => [
            "get" => "getSuccessful",
            "set" => "setSuccessful"
        ],
        "system_cron_audit_response" => [
            "get" => "getResponse",
            "set" => "setResponse"
        ],
        "system_cron_audit_duration" => [
            "set" => "setDuration",
            "get" => "getDuration"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new CronAuditMapEntity());
    }
}
