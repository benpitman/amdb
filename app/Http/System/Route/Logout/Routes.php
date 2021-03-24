<?php

use App\Core\Factory\ControllerFactory;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var RouteCollectorProxyInterface $route */

$route->get("/logout[/]", ControllerFactory::getSystemLogout());
