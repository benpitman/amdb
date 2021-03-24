<?php

namespace App\Core\Model;

use Kentron\Template\{AModel, TSoftDeletes};

final class SystemAuth extends AModel
{
    use TSoftDeletes;

    public $primaryKey = "system_auth_id";
    public $timestamps = true;

    protected $table = "system_auth";

    const CREATED_AT = "system_auth_date_created";
    const UPDATED_AT = null;
    const DELETED_AT = "system_auth_date_deleted";
}
