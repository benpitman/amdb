<?php

// Ajax Routes

use App\App;
use Slim\Interfaces\RouteCollectorProxyInterface;
use App\Core\Factory\MiddlewareFactory;

/** @var App $app */

$ajaxGroup = $app->group("/ajax", function (RouteCollectorProxyInterface $route) {

    foreach (glob(__DIR__ . '/*/Routes.php') as $routePath) {
        require_once $routePath;
    }
});

$ajaxGroup->add(MiddlewareFactory::getSystemLogin());
$ajaxGroup->add(MiddlewareFactory::getAudit());
