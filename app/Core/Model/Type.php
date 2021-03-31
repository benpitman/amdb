<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class Type extends AModel
{
    public $primaryKey = "type_id";

    protected $table = "type";
}
