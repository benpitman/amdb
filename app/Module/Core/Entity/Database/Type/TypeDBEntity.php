<?php

namespace App\Module\Core\Entity\Database\Type;

use App\Module\Core\Type\Entity\TypeMapEntity;
use Kentron\Entity\Template\ADBEntity;

final class TypeDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "type_id";

    protected $propertyMap = [
        "type_text" => [
            "get" => "getText",
            "set" => "setText"
        ],
        "type_standardised" => [
            "get" => "getStandardised",
            "set" => "setStandardised"
        ]
    ];

    public function __construct()
    {
        parent::__construct(new TypeMapEntity());
    }
}
