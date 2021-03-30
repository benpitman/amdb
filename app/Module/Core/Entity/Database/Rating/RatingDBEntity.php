<?php

namespace App\Module\Core\Entity\Database\Rating;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\Rating\Entity\RatingMapEntity;

final class RatingDBEntity extends ADBEntity
{
    protected $propertyMap = [
        "rating_imdb_id" => [
            "get" => "getImdbId",
            "set" => "setImdbId"
        ],
        "rating_score" => [
            "get" => "getScore",
            "set" => "setScore"
        ],
        "rating_votes" => [
            "get" => "getVotes",
            "set" => "setVotes"
        ]
    ];

    public function __construct()
    {
        parent::__construct(new RatingMapEntity());
    }
}
