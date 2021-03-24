<?php

use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var RouteCollectorProxyInterface $route */

$route->group(
    "/user",
    function (RouteCollectorProxyInterface $route) {}
);
