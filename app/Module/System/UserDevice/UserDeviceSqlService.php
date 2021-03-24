<?php

namespace App\Module\System\UserDevice;

use Kentron\Facade\Device;
use App\Module\System\Entity\Database\UserDevice\UserDeviceDBEntity;
use App\Module\System\UserDevice\Repository\UserDeviceRepository;

final class UserDeviceSqlService
{
    public static function getCreate (int $userID, ?int $regionID = null): UserDeviceDBEntity
    {
        $userDeviceDBEntity = new UserDeviceDBEntity();
        $userDeviceRepository = new UserDeviceRepository();

        $platform = Device::getPlatform();
        $deviceType = Device::getType();

        if (!is_null($regionID))
        {
            $userDeviceRepository->whereRegionID($regionID);
        }

        $userDeviceRepository->whereUserID($userID);
        $userDeviceRepository->wherePlatform($platform);
        $userDeviceRepository->whereType($deviceType);

        if (!$userDeviceRepository->buildFirst($userDeviceDBEntity))
        {
            $userDeviceRepository->resetOrmModel();

            $userDeviceDBEntity->setUserID($userID);
            $userDeviceDBEntity->setRegionID($regionID ?? null);
            $userDeviceDBEntity->setPlatform($platform);
            $userDeviceDBEntity->setType($deviceType);

            $userDeviceRepository->insertNew($userDeviceDBEntity);
        }

        return $userDeviceDBEntity;
    }

    public static function getOneByID (int $userDeviceID): UserDeviceDBEntity
    {
        $userDeviceDBEntity = new UserDeviceDBEntity();
        $userDeviceRepository = new UserDeviceRepository();

        $userDeviceRepository->whereID($userDeviceID);

        if (!$userDeviceRepository->buildFirst($userDeviceDBEntity))
        {
            $userDeviceDBEntity->addError("Device with ID '{$userDeviceID}' not found");
        }

        return $userDeviceDBEntity;
    }

    public static function verifyDevice (int $userDeviceID): void
    {
        $userDeviceRepository = new UserDeviceRepository();

        $userDeviceRepository->whereID($userDeviceID);
        $userDeviceRepository->updateVerified();

        $userDeviceRepository->runUpdate();
    }

}
