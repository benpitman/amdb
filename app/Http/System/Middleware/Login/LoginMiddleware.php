<?php

namespace App\Http\System\Middleware\Login;

use Kentron\Template\Http\AMiddleware;

use App\Core\Facade\Session;
use App\Module\System\User\UserManagementService;

final class LoginMiddleware extends AMiddleware
{
    private $queryString = "";

    protected function customRun (): void
    {
        if (!$this->verifyUserLoggedIn()) {
            Session::set("location", $_SERVER['REQUEST_URI'] ?? "");
            $this->transportEntity->redirect("/login" . $this->queryString);
        }

        $this->transportEntity->next();
    }

    private function verifyUserLoggedIn (): bool
    {
        if ($this->transportEntity->getRouteName() === "LOGIN") {
            return true;
        }

        $userManagementEntity = UserManagementService::verifyLoginState();

        if ($userManagementEntity->isLoggedIn()) {
            return true;
        }

        if ($userManagementEntity->hasErrorCodes()) {
            $this->queryString = "?" . http_build_query([
                "error_code" => $userManagementEntity->getErrorCodes()
            ]);
        }

        return false;
    }
}
