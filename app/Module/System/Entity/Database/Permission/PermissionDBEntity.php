<?php

namespace App\Module\System\Entity\Database\Permission;

use Kentron\Entity\Template\ADBEntity;

use App\Module\System\Permission\Entity\PermissionMapEntity;

final class PermissionDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "permission_id";

    protected $propertyMap = [
        "permission_bit" => [
            "get" => "getBit",
            "set" => "setBit"
        ],
        "permission_constant" => [
            "get" => "getConstant",
            "set" => "setConstant"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new PermissionMapEntity);
    }
}
