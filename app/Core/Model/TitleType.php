<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class TitleType extends AModel
{
    public $primaryKey = "title_type_id";

    protected $table = "title_type";
}
