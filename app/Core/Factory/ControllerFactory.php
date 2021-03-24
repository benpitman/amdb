<?php

namespace App\Core\Factory;

use Kentron\Factory\AControllerFactory;

use App\Http\Ajax\Controller\Login\LoginController as AjaxLoginController;
use App\Http\Ajax\Controller\Dashboard\DashboardController as AjaxDashboardController;
use App\Http\Ajax\Controller\Store\StoreController as AjaxStoreController;

use App\Http\System\Controller\SystemController;
use App\Http\System\Controller\Login\LoginController as SystemLoginController;
use App\Http\System\Controller\Logout\LogoutController as SystemLogoutController;

final class ControllerFactory extends AControllerFactory
{
    public static function getAjaxLogin (string $method): callable
    {
        return parent::getController(AjaxLoginController::class, $method);
    }

    public static function getAjaxStore (string $method): callable
    {
        return parent::getController(AjaxStoreController::class, $method);
    }

    public static function getAjaxDashboard (string $method): callable
    {
        return parent::getController(AjaxDashboardController::class, $method);
    }

    /**
     * System controllers always run render (except logout)
     */

    public static function getSystem (): callable
    {
        return parent::getController(SystemController::class, "render");
    }

    public static function getSystemLogin (): callable
    {
        return parent::getController(SystemLoginController::class, "render");
    }

    public static function getSystemLogout (): callable
    {
        return parent::getController(SystemLogoutController::class, "destroy");
    }
}
