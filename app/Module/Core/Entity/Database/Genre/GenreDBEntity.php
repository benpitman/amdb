<?php

namespace App\Module\Core\Entity\Database\Genre;

use App\Module\Core\Genre\Entity\GenreMapEntity;
use Kentron\Entity\Template\ADBEntity;

final class GenreDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "genre_id";

    protected $propertyMap = [
        "genre_text" => [
            "get" => "getText",
            "set" => "setText"
        ]
    ];

    public function __construct()
    {
        parent::__construct(new GenreMapEntity());
    }
}
