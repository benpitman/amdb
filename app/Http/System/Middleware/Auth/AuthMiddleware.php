<?php

namespace App\Http\System\Middleware\Auth;

use Kentron\Template\Http\AMiddleware;

use App\Core\Facade\Session;
use App\Core\Store\Local;
use App\Module\System\User\Entity\UserPermissions;

final class AuthMiddleware extends AMiddleware
{
    protected function customRun (): void
    {
        if (Local::isLoggedIn() && !$this->verifyPrivileges()) {
            $this->transportEntity->redirect(Session::get("location") ?? "/");
            Session::set("location", "/");
        }

        $this->transportEntity->next();
    }

    private function verifyPrivileges (): bool
    {
        if ($this->transportEntity->getRouteName() !== "ADMIN") {
            return true;
        }

        if (UserPermissions::isAdmin(Session::getUserPermissions())) {
            return true;
        }

        return false;
    }
}
