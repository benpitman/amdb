<?php

namespace App\Core\Model;

use Kentron\Template\{AModel, TSoftDeletes};

final class UserDeviceToken extends AModel
{
    use TSoftDeletes;

    public $primaryKey = "user_device_token_id";
    public $timestamps = true;

    protected $table = "user_device_token";

    const CREATED_AT = "user_device_token_date_created";
    const UPDATED_AT = null;
    const DELETED_AT = "user_device_token_date_deleted";
}
