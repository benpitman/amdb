<?php

namespace App\Http\Api\Schema;

use App\Core\Service\Schema;

final class SchemaFactory
{
    /**
     * Private methods
     */

    private static function getSchema (string $actionPath, $schemaName): string
    {
        return Schema::get(__DIR__, $actionPath, $schemaName);
    }
}
