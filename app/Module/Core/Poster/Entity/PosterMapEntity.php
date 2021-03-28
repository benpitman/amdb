<?php

namespace App\Module\Core\Poster\Entity;

use Kentron\Entity\Template\AMapEntity;

final class PosterMapEntity extends AMapEntity
{
    private $imdbId;
    private $score;
    private $votes;

    /**
     * Getters
     */

    public function getImdbId(): string
    {
        return $this->imdbId;
    }

    public function getScore(): float
    {
        return $this->score;
    }

    public function getVotes(): int
    {
        return $this->votes;
    }

    /**
     * Setters
     */

    public function setImdbId(string $imdbId): void
    {
        $this->imdbId = $imdbId;
    }

    public function setScore(float $score): void
    {
        $this->score = $score;
    }

    public function setVotes(int $votes): void
    {
        $this->votes = $votes;
    }
}
