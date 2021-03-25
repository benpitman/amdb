<?php

namespace App\Http\Api\Controller;

use Kentron\Template\Http\AController;

// Factories
use App\Http\Api\Schema\SchemaFactory;

/**
 * Abstract extension of the base controller for API routes
 */
abstract class AApiController extends AController
{
    final protected function getSchemaFactory (): string
    {
        return SchemaFactory::class;
    }
}
