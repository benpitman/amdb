<?php

namespace App\Core\Template\Method;

use App\Http\Api\Middleware\Session\SessionMiddleware;

use App\Http\Core\Middleware\Audit\AuditMiddleware;

// System
use App\Http\System\Middleware\Login\LoginMiddleware as SystemLoginMiddleware;
use App\Http\System\Middleware\Auth\AuthMiddleware as SystemAuthMiddleware;

trait TMiddleware
{
    public function getAuditMiddleware (): callable
    {
        return $this->getMiddleware(AuditMiddleware::class);
    }

    public function getSystemLoginMiddleware (): callable
    {
        return $this->getMiddleware(SystemLoginMiddleware::class);
    }

    public function getSystemAuthMiddleware (): callable
    {
        return $this->getMiddleware(SystemAuthMiddleware::class);
    }

    public function getSessionMiddleware (): callable
    {
        return $this->getMiddleware(SessionMiddleware::class);
    }
}
