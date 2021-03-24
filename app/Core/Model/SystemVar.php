<?php

namespace App\Core\Model;

use Kentron\Template\{AModel, TSoftDeletes};

final class SystemVar extends AModel
{
    use TSoftDeletes;

    public $primaryKey = "system_var_id";
    public $timestamps = true;

    protected $table = "system_var";

    const CREATED_AT = "system_var_date_created";
    const UPDATED_AT = null;
    const DELETED_AT = "system_var_date_deleted";
}
