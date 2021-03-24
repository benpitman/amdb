<?php

namespace App\Module\System\User;

use App\Core\Facade\Session;
use App\Module\System\Entity\User\UserSystemEntity;

final class UserService
{
    public function getUser (): UserSystemEntity
    {
        $userSystemEntity = new UserSystemEntity();

        $userSystemEntity->build(Session::getUser());

        return $userSystemEntity;
    }
}
