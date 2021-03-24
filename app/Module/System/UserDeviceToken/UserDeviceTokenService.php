<?php

namespace App\Module\System\UserDeviceToken;

use App\Module\System\Entity\Database\UserDeviceToken\UserDeviceTokenDBEntity;
use App\Module\System\UserDeviceToken\Entity\UserDeviceTokenMapEntity;
use Kentron\Service\Code;

final class UserDeviceTokenService
{
    public static function saveNewCode (int $userDeviceID): UserDeviceTokenMapEntity
    {
        $userDeviceTokenDBEntity = new UserDeviceTokenDBEntity();
        $code = new Code();

        $code->setLength(6);
        $code->setSafeMode(false);

        $userDeviceTokenDBEntity->setUserDeviceID($userDeviceID);
        $userDeviceTokenDBEntity->setCode($code->getDigit()[0]);
        $userDeviceTokenDBEntity->setDateExpires();

        UserDeviceTokenSqlService::deleteByUserDeviceID($userDeviceID);
        UserDeviceTokenSqlService::insertNew($userDeviceTokenDBEntity);

        return $userDeviceTokenDBEntity->getRootEntity();
    }
}
