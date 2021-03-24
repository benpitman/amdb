<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class Permission extends AModel
{
    public $primaryKey = "permission_id";
    public $timestamps = false;

    protected $table = "permission";

    const CREATED_AT = null;
    const UPDATED_AT = null;
    const DELETED_AT = null;
}
