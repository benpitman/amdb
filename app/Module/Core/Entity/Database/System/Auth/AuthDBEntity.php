<?php

namespace App\Module\Core\Entity\Database\System\Auth;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\System\Auth\Entity\AuthMapEntity;

final class AuthDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "system_auth_id";
    protected $dateCreatedColumn = "system_auth_date_created";
    protected $dateDeletedColumn = "system_auth_date_deleted";

    protected $propertyMap = [
        "system_auth_application_name" => [
            "get" => "getApplicationName",
            "set" => "setApplicationName"
        ],
        "system_auth_application_key" => [
            "get" => "getApplicationKey",
            "set" => "setApplicationKey"
        ],
        "system_auth_active" => [
            "get" => "getActive",
            "set" => "setActive"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new AuthMapEntity());
    }
}
