<?php

namespace App\Module\Core\Entity\Database\Poster;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\Poster\Entity\PosterMapEntity;

final class PosterDBEntity extends ADBEntity
{
    protected $propertyMap = [
        "poster_imdb_id" => [
            "get" => "getImdbId",
            "set" => "setImdbId"
        ],
        "poster_small" => [
            "get" => "getSmall",
            "set" => "setSmall"
        ],
        "poster_full" => [
            "get" => "getFull",
            "set" => "setFull"
        ]
    ];

    public function __construct()
    {
        parent::__construct(new PosterMapEntity());
    }
}
