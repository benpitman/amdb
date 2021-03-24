<?php

namespace App\Module\System\Entity\User;

use App\Module\System\User\Entity\UserMapEntity;
use Kentron\Entity\Template\AApiEntity;

final class UserSystemEntity extends AApiEntity
{
    protected $propertyMap = [
        "id" => [
            "get" => "getID",
            "set" => "setID"
        ],
        "display_name" => [
            "get" => "getDisplayName",
            "set" => "setDisplayName"
        ],
        "permissions" => [
            "get" => "getPermissions",
            "set" => "setPermissions"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new UserMapEntity());
    }
}
