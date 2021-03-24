<?php

namespace App\Module\Core\System\Auth\Entity;

use Kentron\Entity\Template\AMapEntity;

final class AuthMapEntity extends AMapEntity
{
    private $applicationName;
    private $applicationKey;
    private $active;

    /**
     * Getters
     */

    public function getApplicationName (): string
    {
        return $this->applicationName;
    }

    public function getApplicationKey (): string
    {
        return $this->applicationKey;
    }

    public function getActive (): int
    {
        return $this->active;
    }

    /**
     * Setters
     */

    public function setApplicationName (string $applicationName): void
    {
        $this->applicationName = $applicationName;
    }

    public function setApplicationKey (string $applicationKey): void
    {
        $this->applicationKey = $applicationKey;
    }

    public function setActive (int $active): void
    {
        $this->active = $active;
    }
}
