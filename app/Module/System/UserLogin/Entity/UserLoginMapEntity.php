<?php

namespace App\Module\System\UserLogin\Entity;

use Kentron\Entity\Template\AMapEntity;

final class UserLoginMapEntity extends AMapEntity
{
    private $userDeviceID;
    private $hash;

    /**
     * Getters
     */

    public function getUserDeviceID (): int
    {
        return $this->userDeviceID;
    }

    public function getHash (): string
    {
        return $this->hash;
    }

    /**
     * Setters
     */

    public function setUserDeviceID (int $userDeviceID): void
    {
        $this->userDeviceID = $userDeviceID;
    }

    public function setHash (string $hash): void
    {
        $this->hash = $hash;
    }
}
