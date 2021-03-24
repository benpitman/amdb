<?php

namespace App\Core\Store;

use Kentron\Store\IStore;

final class Local implements IStore
{
    /**
     * @var bool $isLoggedIn
     */
    private static $isLoggedIn = false;

    /**
     * @var int|null $deviceID
     */
    private static $deviceID = null;

    public static function setUserLogin(int $userLoginID): void
    {
        self::$isLoggedIn = true;
        self::$deviceID = $userLoginID;
    }

    public static function getLoginID(): ?int
    {
        return self::$deviceID;
    }

    public static function isLoggedIn(): bool
    {
        return self::$isLoggedIn;
    }

    public static function reset(bool $hard = false): void
    {
        self::$isLoggedIn = false;
        self::$deviceID = null;
    }
}
