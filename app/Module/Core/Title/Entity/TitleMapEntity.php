<?php

namespace App\Module\Core\Title\Entity;

use App\Module\Core\Genre\Entity\GenreCollectionEntity;
use Kentron\Entity\Template\AMapEntity;

final class TitleMapEntity extends AMapEntity
{
    /**
     * @var string
     */
    private $imdbId;
    /**
     * @var int
     */
    private $titleTypeId;
    /**
     * @var string|null
     */
    private $primary;
    /**
     * @var string
     */
    private $original;
    /**
     * @var string|null
     */
    private $description;
    /**
     * @var int|null
     */
    private $runtime;
    /**
     * @var int|null
     */
    private $startYear;
    /**
     * @var int|null
     */
    private $endYear;

    // Non-table properties

    /**
     * @var GenreCollectionEntity
     */
    private $genreCollectionEntity;

    /**
     * Setters
     */

    public function setImdbId(string $imdbId): void
    {
        $this->imdbId = $imdbId;
    }

    public function setTitleTypeId(int $titleTypeId): void
    {
        $this->titleTypeId = $titleTypeId;
    }

    public function setPrimary(string $primary): void
    {
        $this->primary = $primary;
    }

    public function setOriginal(string $original): void
    {
        $this->original = $original;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setRuntime(int $runtime): void
    {
        $this->runtime = $runtime;
    }

    public function setStartYear(int $startYear): void
    {
        $this->startYear = $startYear;
    }

    public function setEndYear(int $endYear): void
    {
        $this->endYear = $endYear;
    }

    public function setGenreCollectionEntity(GenreCollectionEntity $genreCollectionEntity): void
    {
        $this->genreCollectionEntity = $genreCollectionEntity;
    }

    /**
     * Getters
     */

    public function getImdbId(): string
    {
        return $this->imdbId;
    }

    public function getTitleTypeId(): int
    {
        return $this->titleTypeId;
    }

    public function getGenres(): array
    {
        return $this->genreCollectionEntity->map(["getText"], true);
    }

    public function getPrimary(): ?string
    {
        return $this->primary;
    }

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    public function getStartYear(): ?int
    {
        return $this->startYear;
    }

    public function getEndYear(): ?int
    {
        return $this->endYear;
    }

    public function getGenreCollectionEntity(): ?GenreCollectionEntity
    {
        return $this->genreCollectionEntity;
    }
}
