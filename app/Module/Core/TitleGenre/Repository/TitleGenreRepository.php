<?php

namespace App\Module\Core\TitleGenre\Repository;

use Kentron\Template\ARepository;

final class TitleGenreRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\TitleGenre::class;

    public function whereImdbId(string $imdbId): void
    {
        parent::where("title_genre_imdb_id", $imdbId);
    }

    public function joinGenre(): void
    {
        parent::leftJoin("genre", "genre_id", "title_genre_genre_id");
    }
}
