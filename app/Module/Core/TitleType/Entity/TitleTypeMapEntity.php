<?php

namespace App\Module\Core\TitleType\Entity;

use Kentron\Entity\Template\AMapEntity;

final class TitleTypeMapEntity extends AMapEntity
{
    private $text;
    private $standardised;

    /**
     * Getters
     */

    public function getText(): string
    {
        return $this->text;
    }

    public function getStandardised(): string
    {
        return $this->standardised;
    }

    /**
     * Setters
     */

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function setStandardised(string $standardised): void
    {
        $this->standardised = $standardised;
    }
}
