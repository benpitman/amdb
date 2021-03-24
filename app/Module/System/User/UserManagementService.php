<?php

namespace App\Module\System\User;

use App\Core\Facade\Cookie;
use App\Core\Facade\Session;
use App\Core\Store\Local;
use App\Module\System\User\Entity\UserManagementEntity;
use App\Module\System\Entity\Database\UserLogin\UserLoginDBEntity;
use App\Module\System\User\Entity\UserMapEntity;
use App\Module\System\UserDevice\UserDeviceSqlService;
use App\Module\System\UserLogin\UserLoginSqlService;
use Kentron\Facade\DT;
use Kentron\Service\Code;

final class UserManagementService
{
    public static function setNewLogin (UserMapEntity $userMapEntity): void
    {
        $userLoginDBEntity = new UserLoginDBEntity();
        $code = new Code();

        $code->setSafeMode(false);
        $code->setLength(64);
        $hash = $code->getAlphaNumeric()[0];

        $userLoginDBEntity->setUserDeviceID($userMapEntity->getDeviceID());
        $userLoginDBEntity->setHash($hash);

        UserLoginSqlService::insertOne($userLoginDBEntity);

        Cookie::setUserToken($hash);
        self::setSession($userMapEntity);
        Local::setUserLogin($userLoginDBEntity->getID());
    }

    public static function verifyLoginState (): UserManagementEntity
    {
        $expiryDate = Session::getUserExpiryDate();
        $userLoginToken = Cookie::getUserToken();
        $userManagementEntity = new UserManagementEntity();

        if (is_string($userLoginToken)) { // Should always be set, unless cookies are blocked
            $userLoginDBEntity = UserLoginSqlService::getOneByHash($userLoginToken);

            if (is_null($userLoginDBEntity)) {
                $userManagementEntity->addErrorCode($userManagementEntity::CODE_INVALID_TOKEN);
                return $userManagementEntity;
            }

            Cookie::updateUserTokenDateExpires();
            Local::setUserLogin($userLoginDBEntity->getID());
        }

        // In the future
        if (is_string($expiryDate) && DT::then($expiryDate)->compare() === 1) {
            Session::setUserExpiryDate();
            $userManagementEntity->setLoggedIn();

            return $userManagementEntity;
        }
        // Date is set but expired
        else if (is_string($expiryDate)) {
            $userManagementEntity->addErrorCode($userManagementEntity::CODE_SESSION_EXPIRED);
        }

        if (is_null($userLoginToken)) {
            return $userManagementEntity;
        }

        $userDeviceDBEntity = UserDeviceSqlService::getOneByID($userLoginDBEntity->getUserDeviceID());
        $userDBEntity = UserSqlService::getOneByID($userDeviceDBEntity->getUserID());

        self::setSession($userDBEntity->getRootEntity());
        $userManagementEntity->setLoggedIn();

        return $userManagementEntity;
    }

    public static function logout (): void
    {
        $userLoginToken = Cookie::getUserToken();

        if (is_string($userLoginToken)) {
            UserLoginSqlService::deleteByHash($userLoginToken);
            Cookie::logout();
        }

        Session::destroy();
    }

    private static function setSession (UserMapEntity $userMapEntity): void
    {
        Session::setUser($userMapEntity);
    }
}
