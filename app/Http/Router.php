<?php

namespace App\Http;

use Kentron\Template\Http\ARouter;

final class Router extends ARouter
{
    protected static $apiRoutePath = __DIR__ . "/Api/Route/Routes.php";
    protected static $ajaxRoutePath = __DIR__ . "/Ajax/Route/Routes.php";
    protected static $systemRoutePath = __DIR__ . "/System/Route/Routes.php";
}
