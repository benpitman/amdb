<?php

namespace App\Module\Core\Entity\Database\Region;

use App\Module\Core\Region\Entity\RegionMapEntity;
use Kentron\Entity\Template\ADBEntity;

final class RegionDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "region_id";

    protected $propertyMap = [
        "region_code" => [
            "get" => "getCode",
            "set" => "setCode"
        ],
        "region_name" => [
            "get" => "getName",
            "set" => "setName"
        ],
        "region_country_code" => [
            "get" => "getCountryCode",
            "set" => "setCountryCode"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new RegionMapEntity());
    }
}
