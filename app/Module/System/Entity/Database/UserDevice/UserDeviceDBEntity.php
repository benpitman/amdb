<?php

namespace App\Module\System\Entity\Database\UserDevice;

use App\Module\System\UserDevice\Entity\UserDeviceMapEntity;
use Kentron\Entity\Template\ADBEntity;

final class UserDeviceDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "user_device_id";

    protected $propertyMap = [
        "user_device_user_id" => [
            "get" => "getUserID",
            "set" => "setUserID"
        ],
        "user_device_region_id" => [
            "get" => "getRegionID",
            "set" => "setRegionID"
        ],
        "user_device_platform" => [
            "get" => "getPlatform",
            "set" => "setPlatform"
        ],
        "user_device_type" => [
            "get" => "getType",
            "set" => "setType"
        ],
        "user_device_verified" => [
            "get" => "getVerified",
            "set" => "setVerified"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new UserDeviceMapEntity());
    }
}
