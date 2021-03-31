<?php

namespace App\Module\Core\TitleGenre\Entity;

use App\Module\Core\Genre\Entity\GenreMapEntity;
use Kentron\Entity\Template\AMapEntity;

final class TitleGenreMapEntity extends AMapEntity
{
    /**
     * @var string
     */
    private $imdbId;
    /**
     * @var int
     */
    private $genreId;

    // Non-table properties

    /**
     * @var GenreMapEntity
     */
    private $genreMapEntity;

    /**
     * Getters
     */

    public function getImdbId(): string
    {
        return $this->imdbId;
    }

    public function getGenreId(): int
    {
        return $this->genreId;
    }

    public function getGenreMapEntity(): GenreMapEntity
    {
        return $this->genreMapEntity;
    }

    /**
     * Setters
     */

    public function setImdbId(string $imdbId): void
    {
        $this->imdbId = $imdbId;
    }

    public function setGenreId(int $genreId): void
    {
        $this->genreId = $genreId;
    }

    public function setGenreMapEntity(GenreMapEntity $genreMapEntity): void
    {
        $this->genreMapEntity = $genreMapEntity;
    }

    /**
     * Helpers
     */

    public function getText(): string
    {
        return $this->genreMapEntity->getText();
    }

    public function getStandardised(): string
    {
        return $this->genreMapEntity->getStandardised();
    }
}
