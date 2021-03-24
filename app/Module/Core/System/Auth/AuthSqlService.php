<?php

namespace App\Module\Core\System\Auth;

use App\Module\Core\Entity\Database\System\Auth\AuthDBEntity;
use App\Module\Core\System\Auth\Repository\AuthRepository;

final class AuthSqlService
{
    public static function getOneByApplicationKey (string $applicationKey): AuthDBEntity
    {
        $authRepository = new AuthRepository();
        $authDBEntity = new AuthDBEntity();

        $authRepository->whereActive();
        $authRepository->whereApplicationKey($applicationKey);

        if (!$authRepository->buildFirst($authDBEntity)) {
            $authDBEntity->addError("Application with this token does not exist or is disabled");
            return $authDBEntity;
        }

        return $authDBEntity;
    }
}
