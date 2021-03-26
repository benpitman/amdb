<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class SystemCronAudit extends AModel
{
    public $primaryKey = "system_cron_audit_id";
    public $timestamps = true;

    protected $table = "system_cron_audit";

    const CREATED_AT = "system_cron_audit_date_created";
}
