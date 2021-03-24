<?php

namespace App\Module\System\UserDevice\Repository;

use Kentron\Template\ARepository;

final class UserDeviceRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\UserDevice::class;

    public function whereID (int $ID): void
    {
        parent::where("user_device_id", $ID);
    }

    public function whereUserID (int $userID): void
    {
        parent::where("user_device_user_id", $userID);
    }

    public function whereRegionID (int $regionID): void
    {
        parent::where("user_device_region_id", $regionID);
    }

    public function wherePlatform (string $platform): void
    {
        parent::where("user_device_platform", $platform);
    }

    public function whereType (string $type): void
    {
        parent::where("user_device_type", $type);
    }

    public function whereVerified (bool $verified = true): void
    {
        parent::where("user_device_verified", intval($verified));
    }

    public function updateVerified (): void
    {
        $this->addUpdate("user_device_verified", 1);
    }
}
