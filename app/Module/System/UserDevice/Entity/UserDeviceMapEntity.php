<?php

namespace App\Module\System\UserDevice\Entity;

use Kentron\Entity\Template\AMapEntity;

final class UserDeviceMapEntity extends AMapEntity
{
    private $userID;
    private $regionID;
    private $platform;
    private $type;
    private $verified = 0;

    /**
     * Getters
     */

    public function getUserID (): int
    {
        return $this->userID;
    }

    public function getRegionID (): ?int
    {
        return $this->regionID;
    }

    public function getPlatform (): string
    {
        return $this->platform;
    }

    public function getType (): string
    {
        return $this->type;
    }

    public function getVerified (): int
    {
        return $this->verified;
    }

    /**
     * Setters
     */

    public function setUserID (int $userID): void
    {
        $this->userID = $userID;
    }

    public function setRegionID (?int $regionID): void
    {
        $this->regionID = $regionID;
    }

    public function setPlatform (string $platform): void
    {
        $this->platform = $platform;
    }

    public function setType (string $type): void
    {
        $this->type = $type;
    }

    public function setVerified (int $verified): void
    {
        $this->verified = $verified;
    }

    /**
     * Helpers
     */

    public function isVerified (): bool
    {
        return !!$this->verified;
    }
}
