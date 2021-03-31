<?php

namespace App\Core\Factory;

use Kentron\Factory\AControllerFactory;

use App\Http\Api\Controller\Title\TitleController as ApiTitleController;

final class ControllerFactory extends AControllerFactory
{
    public static function getApiTitle (string $method): callable
    {
        return parent::getController(ApiTitleController::class, $method);
    }
}
