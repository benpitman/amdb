<?php

namespace App\Core\Facade;

use Kentron\Facade\View as KentronView;

final class View extends KentronView
{
    private const VIEW_DIR = APP_DIR . "/View";

    /**
     * Factories
     */

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
