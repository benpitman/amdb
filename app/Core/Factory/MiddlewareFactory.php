<?php

namespace App\Core\Factory;

use Kentron\Factory\AMiddlewareFactory;

use App\Http\Core\Middleware\Audit\AuditMiddleware;

// Api
use App\Http\Api\Middleware\Auth\AuthMiddleware as ApiAuthMiddleware;

final class MiddlewareFactory extends AMiddlewareFactory
{
    // Core

    public static function getAudit (): callable
    {
        return parent::getMiddleware(AuditMiddleware::class);
    }

    // Api

    public static function getApiAuth (): callable
    {
        return parent::getMiddleware(ApiAuthMiddleware::class);
    }
}
