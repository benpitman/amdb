<?php

namespace App\Module\Core\System\Auth\Repository;

use Kentron\Template\ARepository;

final class AuthRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\SystemAuth::class;

    public function whereActive (): void
    {
        parent::where("system_auth_active", 1);
    }

    public function whereApplicationKey (string $applicationKey): void
    {
        parent::where("system_auth_application_key", $applicationKey);
    }
}
