<?php

namespace App\Core\Factory;

use Kentron\Factory\AControllerFactory;

use App\Http\Api\Controller\Search\SearchController as ApiSearchController;

final class ControllerFactory extends AControllerFactory
{
    public static function getApiSearch (string $method): callable
    {
        return parent::getController(ApiSearchController::class, $method);
    }
}
