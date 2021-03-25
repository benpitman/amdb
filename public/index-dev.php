<?php

declare(strict_types = 1);

ini_set('display_errors', "stderr");
ini_set('display_startup_errors', "1");

error_reporting(E_ALL);

define("PUBLIC_DIR", __DIR__);
define("ROOT_DIR", realpath(PUBLIC_DIR . "/.."));
define("APP_DIR", ROOT_DIR . "/app");
define("STORAGE_DIR", ROOT_DIR . "/storage");

// Set date time
date_default_timezone_set('Europe/London');

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Require the autoloader
require ROOT_DIR . '/vendor/autoload.php';

$app = new App\App(
    new Nyholm\Psr7\Factory\Psr17Factory()
);

$app->boot();
$app->run();
