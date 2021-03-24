<?php

namespace App\Module\System\UserDeviceToken\Repository;

use Kentron\Template\ARepository;

final class UserDeviceTokenRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\UserDeviceToken::class;

    public function whereID (int $ID): void
    {
        parent::where("user_device_token_id", $ID);
    }

    public function whereUserDeviceID (int $userDeviceID): void
    {
        parent::where("user_device_token_user_device_id", $userDeviceID);
    }

    public function whereCode (string $code): void
    {
        parent::where("user_device_token_code", $code);
    }
}
