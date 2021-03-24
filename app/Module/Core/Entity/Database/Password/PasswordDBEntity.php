<?php

namespace App\Module\Core\Entity\Database\Password;

use App\Module\System\Password\Entity\PasswordMapEntity;
use Kentron\Entity\Template\ADBEntity;

final class PasswordDBEntity extends ADBEntity
{
    protected $primaryIDColumn = "password_id";
    protected $dateCreatedColumn = "password_date_created";
    protected $dateDeletedColumn = "password_date_deleted";

    protected $propertyMap = [
        "password_hash" => [
            "get" => "getHash",
            "set" => "setHash"
        ]
    ];

    public function __construct ()
    {
        parent::__construct(new PasswordMapEntity());
    }
}
