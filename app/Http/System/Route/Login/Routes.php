<?php

use App\Core\Factory\ControllerFactory;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var RouteCollectorProxyInterface $route */

$route->group(
    "/login",
    function (RouteCollectorProxyInterface $route)
    {
        $route->get("[/]", ControllerFactory::getSystemLogin())->setName("LOGIN");
    }
);
