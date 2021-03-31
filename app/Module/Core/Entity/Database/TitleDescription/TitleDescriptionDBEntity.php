<?php

namespace App\Module\Core\Entity\Database\TitleDescription;

use App\Module\Core\TitleDescription\Entity\TitleDescriptionMapEntity;
use Kentron\Entity\Template\ADBEntity;

final class TitleDescriptionDBEntity extends ADBEntity
{
    protected $propertyMap = [
        "title_description_imdb_id" => [
            "get" => "getImdbId",
            "set" => "setImdbId"
        ],
        "title_description_text" => [
            "get" => "getText",
            "set" => "setText"
        ]
    ];

    public function __construct()
    {
        parent::__construct(new TitleDescriptionMapEntity());
    }
}
