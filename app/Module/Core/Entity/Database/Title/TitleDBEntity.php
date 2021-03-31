<?php

namespace App\Module\Core\Entity\Database\Title;

use App\Module\Core\Title\Entity\TitleMapEntity;
use Kentron\Entity\Template\ADBEntity;

final class TitleDBEntity extends ADBEntity
{
    protected $propertyMap = [
        "title_imdb_id" => [
            "get" => "getImdbId",
            "set" => "setImdbId"
        ],
        "title_type_id" => [
            "get" => "getTypeId",
            "set" => "setTypeId"
        ],
        "title_primary" => [
            "get" => "getPrimary",
            "set" => "setPrimary"
        ],
        "title_original" => [
            "get" => "getOriginal",
            "set" => "setOriginal"
        ],
        "title_description" => [
            "get" => "getDescription",
            "set" => "setDescription"
        ],
        "title_runtime" => [
            "get" => "getRuntime",
            "set" => "setRuntime"
        ],
        "title_start_year" => [
            "get" => "getStartYear",
            "set" => "setStartYear"
        ],
        "title_end_year" => [
            "get" => "getEndYear",
            "set" => "setEndYear"
        ]
    ];

    public function __construct()
    {
        parent::__construct(new TitleMapEntity());
    }
}
