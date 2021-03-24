<?php

// Api Routes

use App\App;
use App\Core\Factory\MiddlewareFactory;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var App $app */
$apiGroup = $app->group("/api", function (RouteCollectorProxyInterface $group) {});

$apiGroup->add(MiddlewareFactory::getAudit());
