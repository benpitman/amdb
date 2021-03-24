<?php

namespace App\Module\System\Password;

use App\Core\Template\ISqlService;
use App\Module\Core\Entity\Database\Password\PasswordDBEntity;
use App\Module\System\Password\Repository\PasswordRepository;

final class PasswordSqlService implements ISqlService
{
    public static function getOneByID (int $passwordID): ?PasswordDBEntity
    {
        $passwordDBEntity = new PasswordDBEntity();
        $passwordRepository = new PasswordRepository();

        $passwordRepository->whereID($passwordID);

        if (!$passwordRepository->buildFirst($passwordDBEntity))
        {
            return null;
        }

        return $passwordDBEntity;
    }
}
