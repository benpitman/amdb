<?php

namespace App\Module\Core\TitlePoster\Entity;

use Kentron\Entity\Template\AMapEntity;

final class TitlePosterMapEntity extends AMapEntity
{
    /**
     * @var string
     */
    private $imdbId;
    /**
     * @var string|null
     */
    private $small;
    /**
     * @var string|null
     */
    private $full;

    /**
     * Getters
     */

    public function getImdbId(): string
    {
        return $this->imdbId;
    }

    public function getSmall(): ?string
    {
        return $this->small;
    }

    public function getFull(): ?string
    {
        return $this->full;
    }

    /**
     * Setters
     */

    public function setImdbId(string $imdbId): void
    {
        $this->imdbId = $imdbId;
    }

    public function setSmall(?string $small): void
    {
        $this->small = $small;
    }

    public function setFull(?string $full): void
    {
        $this->full = $full;
    }
}
