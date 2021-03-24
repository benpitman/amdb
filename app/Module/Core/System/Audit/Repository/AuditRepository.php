<?php

namespace App\Module\Core\System\Audit\Repository;

use Kentron\Template\ARepository;

final class AuditRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\SystemAudit::class;

    public function whereID (int $auditID): void
    {
        parent::where("system_audit_id", $auditID);
    }

    public function updateResponseBody (string $responseBody): void
    {
        $this->addUpdate("system_audit_response_body", $responseBody);
    }

    public function updateDuration (string $duration): void
    {
        $this->addUpdate("system_audit_duration", $duration);
    }

    public function updateStatusCode (int $statusCode): void
    {
        $this->addUpdate("system_audit_status_code", $statusCode);
    }
}
