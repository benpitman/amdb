<?php

namespace App\Core\Facade;

use App\Core\Store\Variable\Variable;
use App\Module\System\User\Entity\UserMapEntity;

use Kentron\Facade\DT;
use Kentron\Service\System\Session as KentronSession;

final class Session extends KentronSession
{
    public static function getUser (): ?array
    {
        return $_SESSION["user"] ?? null;
    }

    public static function getUserID (): ?int
    {
        return $_SESSION["user"]["user_id"] ?? null;
    }

    public static function getUserPermissions (): int
    {
        return $_SESSION["user"]["permissions"] ?? 0;
    }

    public static function getUserExpiryDate (): ?string
    {
        return $_SESSION["user"]["date_expires"] ?? null;
    }

    public static function setUser (UserMapEntity $userMapEntity): void
    {
        $_SESSION["user"]["id"] = $userMapEntity->getID();
        $_SESSION["user"]["display_name"] = $userMapEntity->getDisplayName();
        $_SESSION["user"]["permissions"] = $userMapEntity->getPermissions();
        $_SESSION["user"]["accepted_cookies"] = $userMapEntity->hasAcceptedCookies();

        self::setUserExpiryDate();
    }

    public static function setUserExpiryDate (?DT $expiryDate = null): void
    {
        if (is_null($expiryDate))
        {
            $expiryDate = DT::now()->increment(0, 30);
        }

        $_SESSION["user"]["date_expires"] = $expiryDate->format(Variable::getDefaultDateTimeFormat());
    }

    public static function unsetUser (): void
    {
        $_SESSION["user"] = null;
    }
}
