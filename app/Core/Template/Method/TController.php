<?php

namespace App\Core\Template\Method;

use App\Http\Ajax\Controller\Login\LoginController as AjaxLoginController;
use App\Http\Ajax\Controller\Dashboard\DashboardController as AjaxDashboardController;
use App\Http\Ajax\Controller\Store\StoreController as AjaxStoreController;

use App\Http\System\Controller\SystemController;
use App\Http\System\Controller\File\FileController as SystemFileController;
use App\Http\System\Controller\Login\LoginController as SystemLoginController;
use App\Http\System\Controller\Logout\LogoutController as SystemLogoutController;

trait TController
{
    public function getAjaxLoginController (string $method): callable
    {
        return $this->getController(AjaxLoginController::class, $method);
    }

    public function getAjaxStoreController (string $method): callable
    {
        return $this->getController(AjaxStoreController::class, $method);
    }

    public function getAjaxDashboardController (string $method): callable
    {
        return $this->getController(AjaxDashboardController::class, $method);
    }

    /**
     * System controllers always run render (except logout)
     */

    public function getSystemController (): callable
    {
        return $this->getController(SystemController::class, "render");
    }

    public function getSystemFileController (): callable
    {
        return $this->getController(SystemFileController::class, "serve");
    }

    public function getSystemLoginController (): callable
    {
        return $this->getController(SystemLoginController::class, "render");
    }

    public function getSystemLogoutController (): callable
    {
        return $this->getController(SystemLogoutController::class, "destroy");
    }
}
