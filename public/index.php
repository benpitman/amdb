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

// Boot the app
$psr17Factory = new Nyholm\Psr7\Factory\Psr17Factory();
$app = new App\App($psr17Factory);

$app->boot();

$relay = new Spiral\Goridge\StreamRelay(STDIN, STDOUT);
$worker = new Spiral\RoadRunner\Worker($relay);
$psr7 = new Spiral\RoadRunner\PSR7Client($worker, $psr17Factory, $psr17Factory, $psr17Factory);

while ($request = $psr7->acceptRequest()) {
    try {
        $resp = $app->handle($request);

        $psr7->respond($resp);
    } catch (\Throwable $e) {
        $psr7->getWorker()->error((string)$e);
    }

    $app->reset();
}

// $app = new App\App(
//     new Nyholm\Psr7\Factory\Psr17Factory()
// );

// $app->boot();
// $app->run();
