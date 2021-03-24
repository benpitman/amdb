<?php

namespace App\Core\Model;

use Kentron\Template\{AModel, TSoftDeletes};

final class UserLogin extends AModel
{
    use TSoftDeletes;

    public $primaryKey = "user_login_id";
    public $timestamps = true;

    protected $table = "user_login";

    const CREATED_AT = "user_login_date_created";
    const UPDATED_AT = null;
    const DELETED_AT = "user_login_date_deleted";
}
