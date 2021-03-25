<?php

namespace App\Module\Core\Entity\Database\Package;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\Package\Entity\PackageMapEntity;

final class PackageDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "package_id";

    protected $propertyMap = [
        "package_class_path" => [
            "set" => "setClassPath",
            "get" => "getClassPath"
        ],
        "package_uri" => [
            "set" => "setUri",
            "get" => "getUri"
        ],
        "package_put_name" => [
            "set" => "setPutName",
            "get" => "getPutName"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new PackageMapEntity());
    }
}
