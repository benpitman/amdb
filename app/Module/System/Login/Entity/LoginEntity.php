<?php

namespace App\Module\System\Login\Entity;

use Kentron\Entity\Template\AEntity;

final class LoginEntity extends AEntity
{
    public const CODE_GROUP = 1;
    public const CODE_INVALID_USERNAME = 1;
    public const CODE_MISSING_PASSWORD = 2;
    public const CODE_INVALID_PASSWORD = 4;
    public const CODE_2_FACTOR = 8;
    public const CODE_ACCESS_DENIED = 16;

    private $username;
    private $password;
    private $deviceCode;

    /**
     * Getters
     */

    public function getUsername (): string
    {
        return $this->username;
    }

    public function getPassword (): string
    {
        return $this->password;
    }

    public function getDeviceCode (): ?string
    {
        return $this->deviceCode;
    }

    /**
     * Setters
     */

    public function setUsername (string $username): void
    {
        $this->username = strtolower($username);
    }

    public function setPassword (string $password): void
    {
        $this->password = $password;
    }

    public function setDeviceCode (?string $deviceCode = null): void
    {
        $this->deviceCode = $deviceCode;
    }
}
