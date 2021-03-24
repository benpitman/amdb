<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class Region extends AModel
{
    public $primaryKey = "region_id";
    public $timestamps = false;

    protected $table = "region";

    const CREATED_AT = null;
    const UPDATED_AT = null;
    const DELETED_AT = null;
}
