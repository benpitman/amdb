<?php

use App\Core\Store\Config;
use App\Core\Store\Variable\Variable;
use App\Module\Core\System\Cron\CronService;
use App\Module\Core\System\Variable\VariableSqlService;
use Illuminate\Database\Capsule\Manager as Capsule;

define("ROOT_DIR", realpath(__DIR__ . "/../../.."));
define("APP_DIR", ROOT_DIR . "/app");
define("STORAGE_DIR", ROOT_DIR . "/storage");

// include the composer autoloader
include ROOT_DIR . "/vendor/autoload.php";

// Boot config, database and system variables
Config::load();

$capsule = new Capsule();
$capsule->addConnection(Config::getDatabaseConfig());
$capsule->setAsGlobal();
$capsule->bootEloquent();

Variable::build(VariableSqlService::getAll(), Config::getDatabaseKey());

CronService::run();
