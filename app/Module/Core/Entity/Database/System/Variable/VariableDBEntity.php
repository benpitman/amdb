<?php

namespace App\Module\Core\Entity\Database\System\Variable;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\System\Variable\Entity\VariableMapEntity;

final class VariableDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "system_var_id";
    protected $dateCreatedColumn = "system_var_date_created";

    protected $propertyMap = [
        "system_var_name" => [
            "set" => "setName",
            "get" => "getName"
        ],
        "system_var_value" => [
            "set" => "setValue",
            "get" => "getValue"
        ],
        "system_var_type" => [
            "set" => "setType",
            "get" => "getType"
        ],
        "system_var_encrypted" => [
            "set" => "setEncrypted",
            "get" => "getEncrypted"
        ],
        "system_var_description" => [
            "set" => "setDescription",
            "get" => "getDescription"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new VariableMapEntity());
    }
}
