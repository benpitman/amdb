<?php

namespace App\Module\System\Password\Entity;

use Kentron\Entity\Template\AMapEntity;

final class PasswordMapEntity extends AMapEntity
{
    private $hash;

    /**
     * Getters
     */

    public function getHash (): string
    {
        return $this->hash;
    }

    /**
     * Setters
     */

    public function setHash (string $hash): void
    {
        $this->hash = $hash;
    }
}
