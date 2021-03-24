<?php

namespace App\Core\Model;

use Kentron\Template\{AModel, TSoftDeletes};

final class User extends AModel
{
    use TSoftDeletes;

    public $primaryKey = "user_id";
    public $timestamps = true;

    protected $table = "user";

    const CREATED_AT = "user_date_created";
    const UPDATED_AT = null;
    const DELETED_AT = "user_date_deleted";
}
