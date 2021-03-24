<?php

namespace App\Module\System\Password\Repository;

use Kentron\Template\ARepository;

final class PasswordRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\Password::class;

    public function whereID (int $passwordID): void
    {
        parent::where("password_id", $passwordID);
    }
}
