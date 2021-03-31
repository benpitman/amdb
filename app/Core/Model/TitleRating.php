<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class TitleRating extends AModel
{
    public $primaryKey = "title_rating_id";

    protected $table = "title_rating";
}
