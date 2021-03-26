<?php

namespace App\Module\Core\Genre;

use App\Module\Core\Entity\Database\Genre\GenreDBCollectionEntity;
use App\Module\Core\Entity\Database\Genre\GenreDBEntity;
use App\Module\Core\Genre\Entity\GenreMapEntity;
use App\Module\Core\Genre\Repository\GenreRepository;

final class GenreSqlService
{
    public static function getAll(): GenreDBCollectionEntity
    {
        $genreDBCollectionEntity = new GenreDBCollectionEntity();
        $genreRepository = new GenreRepository();

        $genreRepository->buildAll($genreDBCollectionEntity);

        return $genreDBCollectionEntity;
    }

    public static function insertOne (string $genre): int
    {
        /** @var GenreMapEntity|GenreDBEntity */
        $genreDBEntity = new GenreDBEntity();
        $genreRepository = new GenreRepository();

        $genreDBEntity->setText($genre);

        $genreRepository->insertOne($genreDBEntity);

        return $genreDBEntity->getID();
    }
}
