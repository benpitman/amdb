<?php

namespace App\Http\System\Controller\Logout;

use App\Http\System\Controller\SystemController;
use App\Module\System\User\UserManagementService;

final class LogoutController extends SystemController
{
    public function destroy (): void
    {
        UserManagementService::logout();
        $this->transportEntity->redirect("/login");
    }
}
