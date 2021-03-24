<?php

namespace App\Module\System\Entity\Database\UserDevice;

use App\Module\System\UserDevice\Entity\UserDeviceCollectionEntity;
use Kentron\Entity\Template\ACoreCollectionEntity;

final class UserDeviceDBCollectionEntity extends ACoreCollectionEntity
{
    public function __construct ()
    {
        parent::__construct(new UserDeviceCollectionEntity(), UserDeviceDBEntity::class);
    }
}
