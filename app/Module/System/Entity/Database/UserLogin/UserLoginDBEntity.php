<?php

namespace App\Module\System\Entity\Database\UserLogin;

use App\Module\System\UserLogin\Entity\UserLoginMapEntity;
use Kentron\Entity\Template\ADBEntity;

final class UserLoginDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "user_login_id";
    protected $dateCreatedColumn = "user_login_date_created";
    protected $dateDeletedColumn = "user_login_date_deleted";

    protected $propertyMap = [
        "user_login_user_device_id" => [
            "get" => "getUserDeviceID",
            "set" => "setUserDeviceID"
        ],
        "user_login_hash" => [
            "get" => "getHash",
            "set" => "setHash"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new UserLoginMapEntity());
    }
}
