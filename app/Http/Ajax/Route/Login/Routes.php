<?php

use App\Core\Factory\ControllerFactory;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var RouteCollectorProxyInterface $route */

$route->group(
    "/login",
    function (RouteCollectorProxyInterface $route)
    {
        $route->get("/error/{error_code:[0-9]+}[/]", ControllerFactory::getAjaxLogin("verifyErrorCodes"))->setName("LOGIN");
        $route->post("[/]", ControllerFactory::getAjaxLogin("qualify"))->setName("LOGIN");
    }
);
