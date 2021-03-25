<?php

// Api Routes

use App\App;
use App\Core\Factory\ControllerFactory;
use App\Core\Factory\MiddlewareFactory;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var App $app */
$apiGroup = $app->group("/search", function (RouteCollectorProxyInterface $route) {
    $route->get("[/]", ControllerFactory::getApiSearch("search"));
});

$apiGroup->add(MiddlewareFactory::getAudit());
