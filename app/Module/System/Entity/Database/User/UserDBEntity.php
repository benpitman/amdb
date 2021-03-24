<?php

namespace App\Module\System\Entity\Database\User;

use App\Module\System\User\Entity\UserMapEntity;
use Kentron\Entity\Template\ADBEntity;

final class UserDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "user_id";
    protected $dateCreatedColumn = "user_date_created";
    protected $dateDeletedColumn = "user_date_deleted";

    protected $propertyMap = [
        "user_username" => [
            "get" => "getUsername",
            "set" => "setUsername"
        ],
        "user_display_name" => [
            "get" => "getDisplayName",
            "set" => "setDisplayName"
        ],
        "user_password_id" => [
            "get" => "getPasswordID",
            "set" => "setPasswordID"
        ],
        "user_email" => [
            "get" => "getEmail",
            "set" => "setEmail"
        ],
        "user_permissions" => [
            "get" => "getPermissions",
            "set" => "setPermissions"
        ],
        "user_roaming" => [
            "get" => "getRoaming",
            "set" => "setRoaming"
        ],
        "user_accepted_cookies" => [
            "get" => "getAcceptedCookies",
            "set" => "setAcceptedCookies"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new UserMapEntity());
    }
}
