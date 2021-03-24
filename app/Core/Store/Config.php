<?php

namespace App\Core\Store;

use Kentron\Store\AConfig;

final class Config extends AConfig
{
    protected static $configPath = APP_DIR . "/Core/Config/Config.json";
}
