<?php

namespace App\Module\Core\Genre\Entity;

use Kentron\Entity\Template\AMapEntity;

final class GenreMapEntity extends AMapEntity
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
