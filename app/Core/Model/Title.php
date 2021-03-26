<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class Title extends AModel
{
    public $primaryKey = "title_id";

    protected $table = "title";
}
