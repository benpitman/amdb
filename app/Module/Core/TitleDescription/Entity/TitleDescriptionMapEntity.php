<?php

namespace App\Module\Core\TitleDescription\Entity;

use Kentron\Entity\Template\AMapEntity;

final class TitleDescriptionMapEntity extends AMapEntity
{
    /**
     * @var string
     */
    private $imdbId;
    /**
     * @var string|null
     */
    private $text;

    /**
     * Getters
     */

    public function getImdbId(): string
    {
        return $this->imdbId;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Setters
     */

    public function setImdbId(string $imdbId): void
    {
        $this->imdbId = $imdbId;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }
}
