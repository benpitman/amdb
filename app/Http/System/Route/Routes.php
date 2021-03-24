<?php

// System Routes

use App\App;
use App\Core\Factory\ControllerFactory;
use App\Core\Factory\MiddlewareFactory;
use Nyholm\Psr7\Response;
use Nyholm\Psr7\ServerRequest;
use Nyholm\Psr7\Stream;
use Slim\Interfaces\RouteCollectorProxyInterface;

/** @var RouteCollectorProxyInterface $route */
/** @var App $app */

$app->get("/{static:.+(?:png|js|jpg|jpeg|gif|css|svg)}", function (ServerRequest $req, Response $res, $args) {

    // does the file exist? If so, return it
    $path = PUBLIC_DIR . DIRECTORY_SEPARATOR . $args["static"];
    if (is_file($path)) {
        $type = null;

        switch (pathinfo($args["static"], PATHINFO_EXTENSION)) {
            case "svg":
                $type = "image/svg+xml";
                break;
        };

        if (is_string($type)) {
            $res = $res->withHeader("content-type", $type);
        }

        return $res->withBody(Stream::create(file_get_contents($path)));
    }

    return $res->withStatus(404);
});

$systemGroup = $app->group("", function (RouteCollectorProxyInterface $route) {

    $route->get("[/]", ControllerFactory::getSystem());

    foreach (glob(__DIR__ . '/*/Routes.php') as $routePath) {
        require_once $routePath;
    }
});

$systemGroup->add(MiddlewareFactory::getSystemAuth());
$systemGroup->add(MiddlewareFactory::getSystemLogin());
$systemGroup->add(MiddlewareFactory::getAudit());
