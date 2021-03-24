<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class UserDevice extends AModel
{
    public $primaryKey = "user_device_id";
    public $timestamps = false;

    protected $table = "user_device";

    const CREATED_AT = null;
    const UPDATED_AT = null;
    const DELETED_AT = null;
}
