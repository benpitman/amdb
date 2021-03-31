<?php

namespace App\Module\Core\Entity\Database\TitlePoster;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\TitlePoster\Entity\TitlePosterMapEntity;

final class TitlePosterDBEntity extends ADBEntity
{
    protected $propertyMap = [
        "title_poster_imdb_id" => [
            "get" => "getImdbId",
            "set" => "setImdbId"
        ],
        "title_poster_small" => [
            "get" => "getSmall",
            "set" => "setSmall"
        ],
        "title_poster_full" => [
            "get" => "getFull",
            "set" => "setFull"
        ]
    ];

    public function __construct()
    {
        parent::__construct(new TitlePosterMapEntity());
    }
}
