<?php

namespace App\Module\Core\TitleType\Entity;

use Kentron\Entity\Template\AMapEntity;

final class TitleTypeMapEntity extends AMapEntity
{
    private $text;

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
