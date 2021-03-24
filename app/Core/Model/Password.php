<?php

namespace App\Core\Model;

use Kentron\Template\{AModel, TSoftDeletes};

final class Password extends AModel
{
    use TSoftDeletes;

    public $primaryKey = "password_id";
    public $timestamps = true;

    protected $table = "password";

    const CREATED_AT = "password_date_created";
    const UPDATED_AT = null;
    const DELETED_AT = "password_date_deleted";
}
