<?php

namespace App\Module\System\UserLogin;

use App\Module\System\Entity\Database\UserLogin\UserLoginDBEntity;
use App\Module\System\UserLogin\Repository\UserLoginRepository;

final class UserLoginSqlService
{
    public static function insertOne (UserLoginDBEntity $userLoginDBEntity): void
    {
        $userLoginRepository = new UserLoginRepository();

        self::deleteByDeviceID($userLoginDBEntity->getUserDeviceID());

        $userLoginRepository->insertNew($userLoginDBEntity);
    }

    public static function getOneByHash (string $hash): ?UserLoginDBEntity
    {
        $userLoginDBEntity = new UserLoginDBEntity();
        $userLoginRepository = new UserLoginRepository();

        $userLoginRepository->whereHash($hash);

        if (!$userLoginRepository->buildFirst($userLoginDBEntity))
        {
            return null;
        }

        return $userLoginDBEntity;
    }

    public static function deleteByHash (string $hash): void
    {
        $userLoginRepository = new UserLoginRepository();

        $userLoginRepository->whereHash($hash);

        $userLoginRepository->delete();
    }

    public static function deleteByDeviceID (int $userDeviceID): void
    {
        $userLoginRepository = new UserLoginRepository();

        $userLoginRepository->whereUserDeviceID($userDeviceID);

        $userLoginRepository->delete();
    }
}
