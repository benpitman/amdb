<?php

namespace App\Core\Model;

use Kentron\Template\AModel;

final class TitleDescription extends AModel
{
    public $primaryKey = "title_description_id";

    protected $table = "title_description";
}
