<?php

// Api Routes

use App\App;
use App\Core\Factory\ControllerFactory;
use App\Core\Factory\MiddlewareFactory;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var App $app */
$apiGroup = $app->group("/title", function (RouteCollectorProxyInterface $route) {
    $route->get("/search[/]", ControllerFactory::getApiTitle("search"));
});

$apiGroup->add(MiddlewareFactory::getAudit());
