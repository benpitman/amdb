<?php

namespace App\Module\System\Entity\Database\UserDeviceToken;

use App\Module\System\UserDeviceToken\Entity\UserDeviceTokenMapEntity;
use Kentron\Entity\Template\ADBEntity;

final class UserDeviceTokenDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "user_device_token_id";
    protected $dateCreatedColumn = "user_device_token_date_created";
    protected $dateDeletedColumn = "user_device_token_date_deleted";

    protected $propertyMap = [
        "user_device_token_user_device_id" => [
            "get" => "getUserDeviceID",
            "set" => "setUserDeviceID"
        ],
        "user_device_token_code" => [
            "get" => "getCode",
            "set" => "setCode"
        ],
        "user_device_token_date_expires" => [
            "get" => "getDateExpires",
            "set" => "setDateExpires"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new UserDeviceTokenMapEntity());
    }
}
