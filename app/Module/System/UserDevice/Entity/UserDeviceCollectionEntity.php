<?php

namespace App\Module\System\UserDevice\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class UserDeviceCollectionEntity extends ACollectionEntity
{
    public function __construct ()
    {
        parent::__construct(UserDeviceMapEntity::class);
    }
}
