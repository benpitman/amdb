<?php

namespace App\Module\System\User\Entity;

use Kentron\Entity\Template\AMapEntity;

final class UserMapEntity extends AMapEntity
{
    private $username;
    private $displayName;
    private $passwordID;
    private $email;
    private $permissions;
    private $roaming;
    private $acceptedCookies;

    private $deviceID;

    /**
     * Getters
     */

    public function getUsername (): string
    {
        return $this->username;
    }

    public function getDisplayName (): string
    {
        return $this->displayName;
    }

    public function getPasswordID (): int
    {
        return $this->passwordID;
    }

    public function getEmail (): string
    {
        return $this->email;
    }

    public function getPermissions (): int
    {
        return $this->permissions;
    }

    public function getRoaming (): int
    {
        return $this->roaming;
    }

    public function getAcceptedCookies (): int
    {
        return $this->acceptedCookies;
    }

    public function getDeviceID (): int
    {
        return $this->deviceID;
    }

    /**
     * Setters
     */

    public function setUsername (string $username): void
    {
        $this->username = $username;
    }

    public function setDisplayName (string $displayName): void
    {
        $this->displayName = $displayName;
    }

    public function setPasswordID (string $passwordID): void
    {
        $this->passwordID = $passwordID;
    }

    public function setEmail (string $email): void
    {
        $this->email = $email;
    }

    public function setPermissions (int $permissions): void
    {
        $this->permissions = $permissions;
    }

    public function setRoaming (int $roaming): void
    {
        $this->roaming = $roaming;
    }

    public function setAcceptedCookies (int $acceptedCookies): void
    {
        $this->acceptedCookies = $acceptedCookies;
    }

    public function setDeviceID (int $deviceID): void
    {
        $this->deviceID = $deviceID;
    }

    /**
     * Helpers
     */

    public function hasAllowedRoaming (): bool
    {
        return !!$this->roaming;
    }

    public function hasAcceptedCookies (): bool
    {
        return !!$this->acceptedCookies;
    }
}
