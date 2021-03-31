<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class TitleGenre extends AModel
{
    public $primaryKey = "title_genre_id";

    protected $table = "title_genre";
}
