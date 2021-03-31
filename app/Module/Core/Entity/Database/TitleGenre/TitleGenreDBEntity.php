<?php

namespace App\Module\Core\Entity\Database\TitleGenre;

use App\Module\Core\Entity\Database\Genre\GenreDBEntity;
use App\Module\Core\TitleGenre\Entity\TitleGenreMapEntity;
use Kentron\Entity\Template\ADBEntity;

final class TitleGenreDBEntity extends ADBEntity
{
    protected $propertyMap = [
        "title_genre_imdb_id" => [
            "get" => "getImdbId",
            "set" => "setImdbId"
        ],
        "title_genre_genre_id" => [
            "get" => "getGenreId",
            "set" => "setGenreId"
        ],

        // Genre join
        "genre_text" => [
            "get_class" => "getGenreDBEntity",
            "set_class" => "setGenreDBEntity"
        ]
    ];

    public function __construct()
    {
        parent::__construct(new TitleGenreMapEntity());
    }

    public function getGenreDBEntity(): GenreDBEntity
    {
        return new GenreDBEntity();
    }

    public function setGenreDBEntity(GenreDBEntity $genreDBEntity): void
    {
        $this->setGenreMapEntity($genreDBEntity->getRootEntity());
    }
}
