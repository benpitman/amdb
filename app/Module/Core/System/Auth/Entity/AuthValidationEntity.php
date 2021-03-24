<?php

namespace App\Module\Core\System\Auth\Entity;

use Kentron\Entity\Template\AEntity;

final class AuthValidationEntity extends AEntity
{
    private $authID;

    public function getAuthID (): int
    {
        return $this->authID;
    }

    public function setAuthID (int $authID): void
    {
        $this->authID = $authID;
    }
}
