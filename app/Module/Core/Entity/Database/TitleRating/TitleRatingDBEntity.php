<?php

namespace App\Module\Core\Entity\Database\TitleRating;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\TitleRating\Entity\TitleRatingMapEntity;

final class TitleRatingDBEntity extends ADBEntity
{
    protected $propertyMap = [
        "title_rating_imdb_id" => [
            "get" => "getImdbId",
            "set" => "setImdbId"
        ],
        "title_rating_score" => [
            "get" => "getScore",
            "set" => "setScore"
        ],
        "title_rating_votes" => [
            "get" => "getVotes",
            "set" => "setVotes"
        ]
    ];

    public function __construct()
    {
        parent::__construct(new TitleRatingMapEntity());
    }
}
