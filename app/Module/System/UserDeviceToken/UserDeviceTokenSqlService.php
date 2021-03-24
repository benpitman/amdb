<?php

namespace App\Module\System\UserDeviceToken;

use App\Module\System\Entity\Database\UserDeviceToken\UserDeviceTokenDBEntity;
use App\Module\System\UserDeviceToken\Entity\UserDeviceTokenMapEntity;
use App\Module\System\UserDeviceToken\Repository\UserDeviceTokenRepository;

final class UserDeviceTokenSqlService
{
    public static function insertNew (UserDeviceTokenDBEntity $userDeviceTokenDBEntity): void
    {
        $userDeviceTokenRepository = new UserDeviceTokenRepository();

        $userDeviceTokenRepository->insertNew($userDeviceTokenDBEntity);
    }

    public static function getOneByCode (int $userDeviceID, string $code): UserDeviceTokenDBEntity
    {
        $userDeviceTokenDBEntity = new UserDeviceTokenDBEntity();
        $userDeviceTokenRepository = new UserDeviceTokenRepository();

        $userDeviceTokenRepository->whereUserDeviceID($userDeviceID);
        $userDeviceTokenRepository->whereCode($code);

        if (!$userDeviceTokenRepository->buildFirst($userDeviceTokenDBEntity))
        {
            $userDeviceTokenDBEntity->addErrorCode(UserDeviceTokenMapEntity::CODE_INVALID_TOKEN);
        }

        self::deprecateCode($userDeviceTokenDBEntity->getID());

        return $userDeviceTokenDBEntity;
    }

    public static function deleteByUserDeviceID (int $userDeviceID): void
    {
        $userDeviceTokenRepository = new UserDeviceTokenRepository();

        $userDeviceTokenRepository->whereUserDeviceID($userDeviceID);

        $userDeviceTokenRepository->delete();
    }

    private static function deprecateCode (int $userDeviceTokenID): void
    {
        $userDeviceTokenRepository = new UserDeviceTokenRepository();

        $userDeviceTokenRepository->whereID($userDeviceTokenID);

        $userDeviceTokenRepository->delete();
    }

    // TODO If you delete a device, log out of all with that ID
}
