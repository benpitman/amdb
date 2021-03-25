<?php

namespace App\Module\Core\Entity\Database\System\Error;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\System\Error\Entity\ErrorMapEntity;

final class ErrorDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "system_error_id";
    protected $dateCreatedColumn = "system_error_date_created";

    protected $propertyMap = [
        "system_error_audit_id" => [
            "get" => "getAuditID",
            "set" => "setAuditID"
        ],
        "system_error_text" => [
            "get" => "getText",
            "set" => "setText"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new ErrorMapEntity());
    }
}
