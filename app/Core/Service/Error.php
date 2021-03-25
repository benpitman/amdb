<?php

namespace App\Core\Service;

use App\Core\Facade\Mail;
use App\Core\Store\Variable\Variable;
use App\Module\Core\Entity\Database\System\Error\ErrorDBEntity;
use App\Module\Core\System\Error\ErrorSqlService;
use Kentron\Entity\Template\AEntity;
use App\Module\Core\System\Error\Entity\ErrorMapEntity;

final class Error
{
    /**
     * Save an error or series of errors
     *
     * @param AEntity|string|string[] $error
     *
     * @return void
     */
    public static function save ($error): ErrorDBEntity
    {
        if ($error instanceof AEntity) {
            $error = $error->getErrors();
        }
        else if (is_string($error)) {
            $error = [$error];
        }
        else if (!is_array($error)) {
            throw new \InvalidArgumentException("Error must be a string, array or instance of " . AEntity::class);
        }

        /** @var ErrorMapEntity|ErrorDBEntity */
        $errorDBEntity = new ErrorDBEntity();

        $errorDBEntity->setAuditID(Variable::getAuditID());
        $errorDBEntity->setText(json_encode($error));

        self::saveEntity($errorDBEntity);

        return $errorDBEntity;
    }

    public static function saveEntity (ErrorDBEntity $errorDBEntity): void
    {
        ErrorSqlService::insertOne($errorDBEntity);
    }
}
