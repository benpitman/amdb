<?php

namespace App\Module\System\User\Entity;

final class UserPermissions
{
    private const SYSTEM_ACCESS = 0b0000_0001;
    private const ADMIN = 0b1000_0000;

    public static function allowedAccess (int $permissions): bool
    {
        return $permissions & self::SYSTEM_ACCESS;
    }

    public static function isAdmin (int $permissions): bool
    {
        return $permissions & self::ADMIN;
    }
}
