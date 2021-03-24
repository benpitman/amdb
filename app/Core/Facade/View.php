<?php

namespace App\Core\Facade;

use App\Core\Store\Variable\Variable;
use Kentron\Facade\View as KentronView;

final class View extends KentronView
{
    private const VIEW_DIR = APP_DIR . "/View";

    public function setSession (): void
    {
        $this->addData(["session" => Session::getSession() ?? null]);
    }

    /**
     * Singletons
     */

    public static function getApp (): self
    {
        $view = new self();

        $view->setDirectory(self::VIEW_DIR);
        $view->setTitle(Variable::getSystemName() . " Dashboard");
        $view->setSession();
        $view->addScripts("dist/main.js");

        return $view;
    }

    public static function getLogin (): self
    {
        $view = new self();

        $view->setDirectory(self::VIEW_DIR);
        $view->setTitle(Variable::getSystemName() . " Login");
        $view->removeScripts();
        $view->addScripts("dist/login.js");

        return $view;
    }

    public static function getNewDeviceEmail (): self
    {
        $view = new self("email/new-device");

        $view->setDirectory(self::VIEW_DIR);
        $view->setTitle("New Device");
        $view->removeStyles();
        $view->removeScripts();

        return $view;
    }
}
