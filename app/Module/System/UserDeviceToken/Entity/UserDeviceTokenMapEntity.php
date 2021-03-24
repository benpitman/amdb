<?php

namespace App\Module\System\UserDeviceToken\Entity;

use Kentron\Facade\DT;
use Kentron\Entity\Template\AMapEntity;

final class UserDeviceTokenMapEntity extends AMapEntity
{
    public const CODE_INVALID_TOKEN = 1;

    private $userDeviceID;
    private $code;
    private $dateExpires;

    /**
     * Getters
     */

    public function getUserDeviceID (): int
    {
        return $this->userDeviceID;
    }

    public function getCode (): string
    {
        return $this->code;
    }

    public function getDateExpires (): DT
    {
        return $this->dateExpires;
    }

    /**
     * Setters
     */

    public function setUserDeviceID (int $userDeviceID): void
    {
        $this->userDeviceID = $userDeviceID;
    }

    public function setCode (string $code): void
    {
        $this->code = $code;
    }

    public function setDateExpires (?string $dateExpires = null): void
    {
        if (is_string($dateExpires)) {
            $this->dateExpires = DT::then($dateExpires);
        }
        else {
            $this->dateExpires = DT::now()->increment(600);
        }
    }
}
