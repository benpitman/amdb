<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class Genre extends AModel
{
    public $primaryKey = "genre_id";

    protected $table = "genre";
}
