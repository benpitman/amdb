<?php

namespace App\Module\System\User\Repository;

use Kentron\Template\ARepository;

final class UserRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\User::class;

    public function whereID (int $ID): void
    {
        parent::where("user_id", $ID);
    }

    public function whereUsername (string $username): void
    {
        parent::where("user_username", $username);
    }
}
