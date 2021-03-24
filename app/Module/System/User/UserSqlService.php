<?php

namespace App\Module\System\User;

use App\Core\Template\ISqlService;
use App\Module\System\Entity\Database\User\UserDBEntity;
use App\Module\System\User\Repository\UserRepository;

final class UserSqlService implements ISqlService
{
    public static function getOneByUsername (string $username): ?UserDBEntity
    {
        $userDBEntity = new UserDBEntity();
        $userRepository = new UserRepository();

        $userRepository->whereUsername($username);

        if (!$userRepository->buildFirst($userDBEntity))
        {
            return null;
        }

        return $userDBEntity;
    }

    public static function getOneByID (int $userID): UserDBEntity
    {
        $userDBEntity = new UserDBEntity();
        $userRepository = new UserRepository();

        $userRepository->whereID($userID);

        if (!$userRepository->buildFirst($userDBEntity))
        {
            $userDBEntity->addError("User with ID '{$userID}' not found");
            return $userDBEntity;
        }

        return $userDBEntity;
    }

    // if you delete a user, also delete all devices for that user
}
