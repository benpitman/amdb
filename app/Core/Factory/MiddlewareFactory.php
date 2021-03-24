<?php

namespace App\Core\Factory;

use Kentron\Factory\AMiddlewareFactory;

use App\Http\Api\Middleware\Session\SessionMiddleware;

use App\Http\Core\Middleware\Audit\AuditMiddleware;

// System
use App\Http\System\Middleware\Login\LoginMiddleware as SystemLoginMiddleware;
use App\Http\System\Middleware\Auth\AuthMiddleware as SystemAuthMiddleware;

final class MiddlewareFactory extends AMiddlewareFactory
{
    public static function getAudit (): callable
    {
        return parent::getMiddleware(AuditMiddleware::class);
    }

    public static function getSystemLogin (): callable
    {
        return parent::getMiddleware(SystemLoginMiddleware::class);
    }

    public static function getSystemAuth (): callable
    {
        return parent::getMiddleware(SystemAuthMiddleware::class);
    }

    public static function getSession (): callable
    {
        return parent::getMiddleware(SessionMiddleware::class);
    }
}
