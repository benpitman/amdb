<?php

namespace App\Module\System\User\Entity;

use Kentron\Entity\Template\AEntity;

final class UserManagementEntity extends AEntity
{
    public const CODE_GROUP = 2;
    public const CODE_INVALID_TOKEN = 1;
    public const CODE_SESSION_EXPIRED = 2;

    private $loggedIn = false;

    public function setLoggedIn (bool $loggedIn = true): void
    {
        $this->loggedIn = $loggedIn;
    }

    public function isLoggedIn (): bool
    {
        return $this->loggedIn;
    }

    public function parseErrorCodes (): void
    {
        if ($this->hasErrorCode($this::CODE_SESSION_EXPIRED)) {
            $this->addNotice("User session has expired");
        }

        if ($this->hasErrorCode($this::CODE_INVALID_TOKEN)) {
            $this->addError("Cookie contains an invalid user token");
            return;
        }
    }
}
