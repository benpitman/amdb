<?php

namespace App\Module\Core\Entity\Database\System\Audit;

use Kentron\Entity\Template\ADBEntity;

use App\Module\Core\System\Audit\Entity\AuditMapEntity;

final class AuditDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "system_audit_id";
    protected $dateCreatedColumn = "system_audit_date_created";

    protected $propertyMap = [
        "system_audit_auth_id" => [
            "set" => "setAuthID",
            "get" => "getAuthID"
        ],
        "system_audit_direction" => [
            "set" => "setDirection",
            "get" => "getDirection"
        ],
        "system_audit_route" => [
            "set" => "setRoute",
            "get" => "getRoute"
        ],
        "system_audit_method" => [
            "get" => "getMethod",
            "set" => "setMethod"
        ],
        "system_audit_request_body" => [
            "set" => "setRequestBody",
            "get" => "getRequestBody"
        ],
        "system_audit_response_body" => [
            "set" => "setResponseBody",
            "get" => "getResponseBody"
        ],
        "system_audit_status_code" => [
            "set" => "setStatusCode",
            "get" => "getStatusCode"
        ],
        "system_audit_duration" => [
            "set" => "setDuration",
            "get" => "getDuration"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new AuditMapEntity());
    }
}
