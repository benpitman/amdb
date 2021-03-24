<?php

namespace App\Module\Core\Region\Entity;

use Kentron\Entity\Template\AMapEntity;

final class RegionMapEntity extends AMapEntity
{
    public const CODE_UNKNOWN_LOCATION = 1;

    private $code;
    private $name;
    private $countryCode;

    /**
     * Getters
     */

    public function getCode (): string
    {
        return $this->code;
    }

    public function getName (): string
    {
        return $this->name;
    }

    public function getCountryCode (): string
    {
        return $this->countryCode;
    }

    /**
     * Setters
     */

    public function setCode (string $code): void
    {
        $this->code = $code;
    }

    public function setName (string $name): void
    {
        $this->name = $name;
    }

    public function setCountryCode (string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }
}
