<?php

namespace App\Module\Api\Entity\Title;

use App\Module\Core\Title\Entity\TitleMapEntity;
use Kentron\Entity\Template\AApiEntity;

final class TitleApiEntity extends AApiEntity
{
    protected $propertyMap = [
        "imdb_id" => [
            "get" => "getImdbId"
        ],
        "type" => [
            "get" => "getType"
        ],
        "genres" => [
            "get" => "getGenres"
        ],
        "title" => [
            "get" => "getPrimary"
        ],
        "title_original" => [
            "get" => "getOriginal"
        ],
        "runtime" => [
            "get" => "getRuntime"
        ],
        "start_year" => [
            "get" => "getStartYear"
        ],
        "end_year" => [
            "get" => "getEndYear"
        ]
    ];

    public function __construct(TitleMapEntity $titleMapEntity = null)
    {
        parent::__construct($titleMapEntity ?? new TitleMapEntity());
    }
}
