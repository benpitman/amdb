<?php

namespace App\Module\Core\Entity\Database\System\Cron;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\System\Cron\Entity\CronMapEntity;

final class CronDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "system_cron_id";
    protected $dateCreatedColumn = "system_cron_date_created";
    protected $dateDeletedColumn = "system_cron_date_deleted";

    protected $propertyMap = [
        "system_cron_provider_id" => [
            "get" => "getProviderID",
            "set" => "setProviderID"
        ],
        "system_cron_class" => [
            "get" => "getClass",
            "set" => "setClass"
        ],
        "system_cron_method" => [
            "get" => "getMethod",
            "set" => "setMethod"
        ],
        "system_cron_args" => [
            "get" => "getArgs",
            "set" => "setArgs"
        ],
        "system_cron_interval" => [
            "get" => "getInterval",
            "set" => "setInterval"
        ],
        "system_cron_date_ran" => [
            "get" => "getDateRan",
            "set" => "setDateRan"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new CronMapEntity());
    }
}
