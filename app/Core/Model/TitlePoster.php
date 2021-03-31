<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class TitlePoster extends AModel
{
    public $primaryKey = "title_poster_id";

    protected $table = "title_poster";
}
