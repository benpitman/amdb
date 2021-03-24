<?php

namespace App\Module\System\UserLogin\Repository;

use Kentron\Template\ARepository;

final class UserLoginRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\UserLogin::class;

    public function whereID (int $ID): void
    {
        parent::where("user_login_id", $ID);
    }

    public function whereUserDeviceID (int $userDeviceID): void
    {
        parent::where("user_login_user_device_id", $userDeviceID);
    }

    public function whereHash (string $hash): void
    {
        parent::where("user_login_hash", $hash);
    }
}
