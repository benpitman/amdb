<?php

namespace App\Module\Core\Title\Entity;

use App\Module\Core\TitleGenre\Entity\TitleGenreCollectionEntity;
use Kentron\Entity\Template\AMapEntity;
use App\Module\Core\TitleDescription\Entity\TitleDescriptionMapEntity;
use App\Module\Core\Type\Entity\TypeMapEntity;

final class TitleMapEntity extends AMapEntity
{
    /**
     * @var string
     */
    private $imdbId;
    /**
     * @var int
     */
    private $typeId;
    /**
     * @var string|null
     */
    private $primary;
    /**
     * @var string
     */
    private $original;
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
     * @var TypeMapEntity
     */
    private $typeMapEntity;
    /**
     * @var TitleGenreCollectionEntity|null
     */
    private $titleGenreCollectionEntity;
    /**
     * @var TitleDescriptionMapEntity|null
     */
    private $titleDescriptionMapEntity;

    /**
     * Setters
     */

    public function setImdbId(string $imdbId): void
    {
        $this->imdbId = $imdbId;
    }

    public function setTypeId(int $typeId): void
    {
        $this->typeId = $typeId;
    }

    public function setPrimary(string $primary): void
    {
        $this->primary = $primary;
    }

    public function setOriginal(string $original): void
    {
        $this->original = $original;
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

    public function setTypeMapEntity(TypeMapEntity $typeMapEntity): void
    {
        $this->typeMapEntity = $typeMapEntity;
    }

    public function setTitleGenreCollectionEntity(TitleGenreCollectionEntity $titleGenreCollectionEntity): void
    {
        $this->titleGenreCollectionEntity = $titleGenreCollectionEntity;
    }

    public function setTitleDescriptionMapEntity(TitleDescriptionMapEntity $titleDescriptionMapEntity): void
    {
        $this->titleDescriptionMapEntity = $titleDescriptionMapEntity;
    }

    /**
     * Getters
     */

    public function getImdbId(): string
    {
        return $this->imdbId;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function getPrimary(): ?string
    {
        return $this->primary;
    }

    public function getOriginal(): string
    {
        return $this->original;
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

    public function getTypeMapEntity(): TypeMapEntity
    {
        return $this->typeMapEntity;
    }

    public function getTitleGenreCollectionEntity(): ?TitleGenreCollectionEntity
    {
        return $this->titleGenreCollectionEntity;
    }

    public function getTitleDescriptionMapEntity(): ?TitleDescriptionMapEntity
    {
        return $this->titleDescriptionMapEntity;
    }

    /**
     * Helpers
     */

    public function getType(): string
    {
        return $this->typeMapEntity->getText();
    }

    public function getGenres(): array
    {
        if (is_null($this->titleGenreCollectionEntity)) {
            return [];
        }
        return $this->titleGenreCollectionEntity->map(["getText"], true);
    }

    public function getDescription(): ?string
    {
        if (is_null($this->titleDescriptionMapEntity)) {
            return null;
        }
        return $this->titleDescriptionMapEntity->getText();
    }
}
