<?php

use App\Core\Factory\ControllerFactory;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var RouteCollectorProxyInterface $route */

$route->group(
    "/dashboard",
    function (RouteCollectorProxyInterface $route)
    {
        $route->get("[/]", ControllerFactory::getAjaxDashboard("getMedia"));
    }
);
