<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class SystemAudit extends AModel
{
    public $primaryKey = "system_audit_id";
    public $timestamps = true;

    protected $table = "system_audit";
    protected $dateFormat = 'Y-m-d H:i:s.u';

    const CREATED_AT = "system_audit_date_created";
    const UPDATED_AT = null;
    const DELETED_AT = null;
}
