<?php

namespace App\Module\Core\Title\Entity;

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
     * @var bool
     */
    private $isAdult;
    /**
     * @var int
     */
    private $startYear;
    /**
     * @var int
     */
    private $endYear;
    /**
     * @var int
     */
    private $runtime;
    /**
     * @var string
     */
    private $genres;

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

    public function setIsAdult(bool $isAdult): void
    {
        $this->isAdult = $isAdult;
    }

    public function setStartYear(int $startYear): void
    {
        $this->startYear = $startYear;
    }

    public function setEndYear(int $endYear): void
    {
        $this->endYear = $endYear;
    }

    public function setRuntime(int $runtime): void
    {
        $this->runtime = $runtime;
    }

    public function setGenres(string $genres): void
    {
        $this->genres = $genres;
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

    public function getPrimary(): ?string
    {
        return $this->primary;
    }

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function getIsAdult(): bool
    {
        return $this->isAdult;
    }

    public function getStartYear(): int
    {
        return $this->startYear;
    }

    public function getEndYear(): int
    {
        return $this->endYear;
    }

    public function getRuntime(): int
    {
        return $this->runtime;
    }

    public function getGenres(): string
    {
        return $this->genres;
    }
}
