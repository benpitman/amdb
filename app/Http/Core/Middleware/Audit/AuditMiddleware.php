<?php

namespace App\Http\Core\Middleware\Audit;

use Kentron\Template\Http\AMiddleware;

use App\Core\Store\Variable\Variable;
use App\Module\Core\System\Audit\AuditSqlService;
use App\Module\Core\Entity\Database\System\Audit\AuditDBEntity;

final class AuditMiddleware extends AMiddleware
{
    protected function customRun (): void
    {
        $auditDBEntity = $this->saveRequest();

        $this->transportEntity->next();

        $this->saveResponse($auditDBEntity);
    }

    /**
     * Save the inbound request
     * @return void
     */
    private function saveRequest (): AuditDBEntity
    {
        if ($this->transportEntity->getRouteName() !== "NO_AUDIT") {
            $body = $this->transportEntity->getRequestBody();
        }

        $auditDBEntity = AuditSqlService::saveInboundRequest(
            $this->transportEntity->getRequestUrl(),
            $body ?? null
        );

        Variable::setAuditID($auditDBEntity->getID());

        return $auditDBEntity;
    }

    /**
     * Save the inbound request
     * @return void
     */
    private function saveResponse (AuditDBEntity $auditDBEntity): void
    {
        AuditSqlService::saveResponse(
            $auditDBEntity,
            $this->transportEntity->getBody(),
            $this->transportEntity->getStatusCode()
        );
    }
}
