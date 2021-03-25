<?php

namespace App\Module\Core\System\Error;

use App\Module\Core\Entity\Database\System\Error\ErrorDBEntity;
use App\Module\Core\System\Error\Repository\ErrorRepository;

final class ErrorSqlService
{
    public static function insertOne (ErrorDBEntity $errorDBEntity): void
    {
        $errorRepository = new ErrorRepository();

        $errorRepository->insertOne($errorDBEntity);
    }
}
