<?php

namespace App\Module\Core\Entity\Database\TitleType;

use App\Module\Core\TitleType\Entity\TitleTypeMapEntity;
use Kentron\Entity\Template\ADBEntity;

final class TitleTypeDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "title_type_id";

    protected $propertyMap = [
        "title_type_text" => [
            "get" => "getText",
            "set" => "setText"
        ]
    ];

    public function __construct()
    {
        parent::__construct(new TitleTypeMapEntity());
    }
}
