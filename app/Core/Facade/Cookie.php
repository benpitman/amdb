<?php

namespace App\Core\Facade;

use Kentron\Facade\DT;
use Kentron\Service\System\Cookie as KentronCookie;

final class Cookie extends KentronCookie
{
    public static function setUserToken (string $token): void
    {
        parent::set("user_token", $token, DT::now()->increment(0, 0, 0, 7));
    }

    public static function logout (): void
    {
        parent::unset("user_token");
        parent::logout();
    }

    public static function getUserToken (): ?string
    {
        return parent::get("user_token");
    }

    public static function updateUserTokenDateExpires (): void
    {
        self::setUserToken(self::getUserToken());
    }
}
