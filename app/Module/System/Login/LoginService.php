<?php

namespace App\Module\System\Login;

use Kentron\Service\Password;

use App\Core\Facade\Mail;
use App\Core\Store\Variable\Variable;
use App\Module\Core\Region\Entity\RegionMapEntity;
use App\Module\Core\Region\RegionSqlService;
use App\Module\System\UserDeviceToken\Entity\UserDeviceTokenMapEntity;
use App\Module\System\UserDeviceToken\UserDeviceTokenService;
use App\Module\System\UserDeviceToken\UserDeviceTokenSqlService;
use App\Module\System\Entity\Database\User\UserDBEntity;
use App\Module\System\Login\Entity\LoginEntity;
use App\Module\System\Password\PasswordSqlService;
use App\Module\System\User\Entity\UserPermissions;
use App\Module\System\User\UserManagementService;
use App\Module\System\User\UserSqlService;
use App\Module\System\UserDevice\UserDeviceSqlService;

final class LoginService
{
    public function qualify (LoginEntity $loginEntity): bool
    {
        $userDBEntity = UserSqlService::getOneByUsername($loginEntity->getUsername());

        if (is_null($userDBEntity))
        {
            $loginEntity->addError("Username not found");
            $loginEntity->addErrorCode($loginEntity::CODE_INVALID_USERNAME);
            return false;
        }

        if (!UserPermissions::allowedAccess($userDBEntity->getPermissions())) {
            $loginEntity->addError("You do not have permission to access this site");
            $loginEntity->addErrorCode($loginEntity::CODE_ACCESS_DENIED);
            return false;
        }

        $passwordDBEntity = PasswordSqlService::getOneByID($userDBEntity->getPasswordID());

        if (is_null($passwordDBEntity))
        {
            $loginEntity->addError("This user does not have a valid login");
            $loginEntity->addErrorCode($loginEntity::CODE_MISSING_PASSWORD);
            return false;
        }

        if (!Password::verify($loginEntity->getPassword(), $passwordDBEntity->getHash()))
        {
            $loginEntity->addError("Password is incorrect");
            $loginEntity->addErrorCode($loginEntity::CODE_INVALID_PASSWORD);
            return false;
        }

        if (!$userDBEntity->hasAllowedRoaming() && !Variable::onDev())
        {
            $regionDBEntity = RegionSqlService::getCreate();

            if ($regionDBEntity->hasErrorCode(RegionMapEntity::CODE_UNKNOWN_LOCATION)) {
                $loginEntity->addError("Could not get location");
                return false;
            }

            $regionID = $regionDBEntity->getID();
        }

        $userDeviceDBEntity = UserDeviceSqlService::getCreate($userDBEntity->getID(), $regionID ?? null);

        if ($userDeviceDBEntity->hasErrors()) {
            $loginEntity->addError($userDeviceDBEntity->getErrors());
            return false;
        }

        if (!$userDeviceDBEntity->isVerified())
        {
            $userDeviceID = $userDeviceDBEntity->getID();
            $deviceCode = $loginEntity->getDeviceCode();

            if (is_null($deviceCode))
            {
                $loginEntity->addError("This device is not recognised.");

                if (!$this->sendNewDeviceCode($userDBEntity, $userDeviceID)) {
                    $loginEntity->mergeAlerts($userDBEntity);
                    return false;
                }

                $loginEntity->addNotice("Please enter the verification code we've sent to your email.");
                $loginEntity->addErrorCode($loginEntity::CODE_2_FACTOR);
                return false;
            }
            else
            {
                $userDeviceTokenDBEntity = UserDeviceTokenSqlService::getOneByCode($userDeviceID, $deviceCode);

                if ($userDeviceTokenDBEntity->hasErrorCode(UserDeviceTokenMapEntity::CODE_INVALID_TOKEN))
                {
                    $loginEntity->addError("The device code entered is incorrect.");
                    $loginEntity->addErrorCode($loginEntity::CODE_2_FACTOR);
                    return false;
                }

                UserDeviceSqlService::verifyDevice($userDeviceID);
            }
        }

        $userDBEntity->setDeviceID($userDeviceDBEntity->getID());
        UserManagementService::setNewLogin($userDBEntity->getRootEntity());

        return true;
    }

    private function sendNewDeviceCode (UserDBEntity $userDBEntity, int $userDeviceID): bool
    {
        $userDeviceTokenMapEntity = UserDeviceTokenService::saveNewCode($userDeviceID);

        $mail = Mail::getNewDeviceMail($userDBEntity->getDisplayName(), $userDeviceTokenMapEntity->getCode());

        if (!$mail->send($userDBEntity->getEmail())) {
            $userDBEntity->getErrors();
            return false;
        }

        return true;
    }
}
