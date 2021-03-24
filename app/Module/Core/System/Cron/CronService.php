<?php

namespace App\Module\Core\System\Cron;

use App\Module\Core\System\Cron\CronSqlService;

use App\Module\Core\System\Cron\Entity\{CronEntity, CronMapEntity};

use App\Module\Core\Entity\Database\System\Cron\CronAuditDBCollectionEntity;

use App\Module\Core\System\Cron\Factory\CronFactory;

use App\Module\Core\System\Cron\CronAuditSqlService;

use App\Core\Service\Mail\Mail;

final class CronService
{
    public static function run (): void
    {
        $cronDBCollectionEntity = CronSqlService::getActive();

        if ($cronDBCollectionEntity->countEntities() === 0) {
            return;
        }

        $cronAuditDBCollectionEntity = new CronAuditDBCollectionEntity();

        $erroredCrons = [];

        foreach ($cronDBCollectionEntity->filter([["canRun", "same", true]]) as $cronDBEntity) {
            $auditDBEntity = $cronAuditDBCollectionEntity->getNewCoreEntity();

            $cronEntity = self::execute($cronDBEntity->getRootEntity());

            $auditDBEntity->setCronID($cronDBEntity->getID());
            $auditDBEntity->setDuration($cronEntity->getTimeTaken());
            $auditDBEntity->setResponse($cronEntity->getResponse());
            $auditDBEntity->setSuccessful(!$cronEntity->hasFailed());

            $cronAuditDBCollectionEntity->addEntity($auditDBEntity);
        }

        if ($cronAuditDBCollectionEntity->countEntities() === 0) {
            return;
        }

        CronAuditSqlService::insertMany($cronAuditDBCollectionEntity);

        $erroredCrons = $cronAuditDBCollectionEntity->map(
            ["getID"],
            true,
            [
                ["getSuccessful", "same", false]
            ]
        );

        if (count($erroredCrons) > 0) {
            self::emailCronFailed($erroredCrons);
        }
    }

    private static function execute (CronMapEntity $cronMapEntity): CronEntity
    {
        $cronEntity = new CronEntity();

        try {
            $cronService = CronFactory::getCronController($cronMapEntity);
        }
        catch (\Exception $ex) {
            $cronEntity->setException($ex);
            return $cronEntity;
        }

        $cronService->setCronEntity($cronEntity);

        $method = $cronMapEntity->getMethod();
        try {
            $cronService->$method(...$cronMapEntity->getArgs());
        }
        catch (\Exception $ex) {
            $cronEntity->setException($ex);
            return $cronEntity;
        }
        finally {
            $cronEntity->end();
        }

        CronSqlService::updateDateRan($cronMapEntity->getID());

        return $cronEntity;
    }

    private function emailCronFailed (array $cronAuditIDs): void
    {
        Mail::sendDev(
            "Cron Audit IDs: <" . implode(", ", $cronAuditIDs) . ">",
            "API Bank - Cron Failed"
        );
    }
}
