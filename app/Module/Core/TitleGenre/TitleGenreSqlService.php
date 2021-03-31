<?php

namespace App\Module\Core\TitleGenre;

use App\Module\Core\Entity\Database\Genre\GenreDBEntity;
use App\Module\Core\Entity\Database\TitleGenre\TitleGenreDBCollectionEntity;
use App\Module\Core\TitleGenre\Entity\TitleGenreMapEntity;
use App\Module\Core\TitleGenre\Repository\TitleGenreRepository;
use Illuminate\Database\Capsule\Manager;

final class TitleGenreSqlService
{
    public static function bulkInsert(string $tsvPath): bool
    {
        return Manager::connection()->statement(
            "LOAD DATA LOCAL INFILE '$tsvPath' INTO TABLE `title_genre` FIELDS TERMINATED BY '\\t' LINES TERMINATED BY '\\n'"
        );
    }

    public static function getAllByImdbId(string $imdbId): TitleGenreDBCollectionEntity
    {
        $titleGenreRepository = new TitleGenreRepository();
        $titleGenreDBCollectionEntity = new TitleGenreDBCollectionEntity();

        $titleGenreRepository->whereImdbId($imdbId);
        $titleGenreRepository->joinGenre();

        $titleGenreRepository->buildAll($titleGenreDBCollectionEntity);

        return $titleGenreDBCollectionEntity;
    }
}
