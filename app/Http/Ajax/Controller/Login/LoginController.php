<?php

namespace App\Http\Ajax\Controller\Login;

use App\Core\Facade\Cookie;
use App\Core\Facade\Session;

use App\Http\Ajax\Controller\AAjaxController;

use App\Module\System\Login\Entity\LoginEntity as SystemLoginEntity;
use App\Module\System\Login\LoginService as SystemLoginService;
use App\Module\System\User\Entity\UserManagementEntity as SystemUserManagementEntity;
use Kentron\Service\System\Post;

final class LoginController extends AAjaxController
{
    public function qualify (): void
    {
        $username = Post::getOne("username");
        $password = Post::getOne("password");
        $deviceCode = Post::getOne("device_code");

        if (is_null($username)) {
            $this->transportEntity->addError("Username is missing");
        }
        if (is_null($password)) {
            $this->transportEntity->addError("Password is missing");
        }

        if ($this->transportEntity->hasErrors()) {
            return;
        }

        $systemLoginEntity = new SystemLoginEntity();

        $systemLoginEntity->setUsername($username);
        $systemLoginEntity->setPassword($password);
        $systemLoginEntity->setDeviceCode($deviceCode);

        $systemLoginService = new SystemLoginService();

        if (!$systemLoginService->qualify($systemLoginEntity)) {
            $this->transportEntity->mergeAlerts($systemLoginEntity);

            $this->transportEntity->setData($this->normaliseErrorCodes($systemLoginEntity));
            return;
        }

        $this->transportEntity->setRedirect(Session::get("location") ?? "/");
        $this->transportEntity->addCookies(Cookie::getHeaders());
        Session::unset("location");
    }

    public function verifyErrorCodes (): void
    {
        $errorCode = (int) ($this->transportEntity->getArgs()["error_code"] ?? 0);

        if (!$errorCode) {
            return;
        }

        $userManagementEntity = new SystemUserManagementEntity();
        $userManagementEntity->addErrorCode($errorCode);
        $userManagementEntity->parseErrorCodes();

        $this->transportEntity->mergeAlerts($userManagementEntity);
    }

    private function normaliseErrorCodes (SystemLoginEntity $systemLoginEntity): array
    {
        return [
            "needs_code" => $systemLoginEntity->hasErrorCode($systemLoginEntity::CODE_2_FACTOR)
        ];
    }
}
