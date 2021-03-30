<?php

namespace App\Module\Core\Poster\Entity;

use Kentron\Entity\Template\AMapEntity;

final class PosterMapEntity extends AMapEntity
{
    private $imdbId;
    private $small;
    private $full;

    /**
     * Getters
     */

    public function getImdbId(): string
    {
        return $this->imdbId;
    }

    public function getSmall(): string
    {
        return $this->small;
    }

    public function getFull(): string
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

    public function setSmall(string $small): void
    {
        $this->small = $small;
    }

    public function setFull(string $full): void
    {
        $this->full = $full;
    }
}
