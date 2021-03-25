<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class SystemError extends AModel
{
    public $primaryKey = "system_error_id";
    public $timestamps = true;

    protected $table = "system_error";

    const CREATED_AT = "system_error_date_created";
}
