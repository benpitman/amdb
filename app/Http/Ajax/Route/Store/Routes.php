<?php

use App\Core\Factory\ControllerFactory;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var RouteCollectorProxyInterface $route */

$route->group(
    "/store",
    function (RouteCollectorProxyInterface $route)
    {
        $route->get("/user[/]", ControllerFactory::getAjaxStore("getUser"));
        $route->get("/permissions[/]", ControllerFactory::getAjaxStore("getPermissions"));
    }
);
