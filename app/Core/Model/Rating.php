<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class Rating extends AModel
{
    public $primaryKey = "rating_id";

    protected $table = "rating";
}
