<?php

namespace App\Http\Ajax\Controller\Store;

use App\Http\Ajax\Controller\AAjaxController;
use App\Module\System\Permission\PermissionService;
use App\Module\System\User\UserService;

final class StoreController extends AAjaxController
{
    public function getUser (): void
    {
        $userService = new UserService();

        $userSystemEntity = $userService->getUser();
        $this->transportEntity->setData($userSystemEntity->normalise());
    }

    public function getPermissions (): void
    {
        $permissionService = new PermissionService();
        $this->transportEntity->setData($permissionService->getAll()->normalise());
    }
}
