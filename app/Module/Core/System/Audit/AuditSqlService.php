<?php

namespace App\Module\Core\System\Audit;

use App\Core\Store\Local;

use App\Module\Core\Entity\Database\System\Audit\AuditDBEntity;
use App\Core\Store\Variable\Variable;

use App\Module\Core\System\Audit\Repository\AuditRepository;

use Kentron\Facade\DT;

class AuditSqlService
{
    public static function insertOne (AuditDBEntity $auditDBEntity): void
    {
        $auditRepository = new AuditRepository();

        $auditDBEntity->setAuthID(Variable::getAuthID());

        $auditRepository->insertNew($auditDBEntity);
    }

    public static function saveInboundRequest (string $route, ?string $requestBody = null): AuditDBEntity
    {
        $auditDBEntity = new AuditDBEntity();

        $auditDBEntity->setRoute($route);
        $auditDBEntity->setMethod($_SERVER["REQUEST_METHOD"] ?? null);
        $auditDBEntity->setRequestBody($requestBody);
        $auditDBEntity->setInbound();

        self::insertOne($auditDBEntity);

        return $auditDBEntity;
    }

    public static function saveOutboundRequest (string $route, ?string $requestBody = null): AuditDBEntity
    {
        $auditDBEntity = new AuditDBEntity();

        $auditDBEntity->setRoute($route);
        $auditDBEntity->setRequestBody($requestBody);
        $auditDBEntity->setOutbound();

        self::insertOne($auditDBEntity);

        return $auditDBEntity;
    }

    public static function saveResponse (AuditDBEntity $auditDBEntity, ?string $responseBody = null, ?int $statusCode = null): void
    {
        $auditRepository = new AuditRepository();

        $diff = DT::now()->diff($auditDBEntity->getDateCreated());

        if (is_string($responseBody)) {
            $auditRepository->updateResponseBody($responseBody);
        }

        $auditRepository->whereID($auditDBEntity->getID());
        $auditRepository->updateDuration($diff->format("%H:%I:%S.%F"));

        if (is_int($statusCode)) {
            $auditRepository->updateStatusCode($statusCode);
        }

        $auditRepository->runUpdate();

        $auditRepository->buildFirst($auditDBEntity);
    }
}
