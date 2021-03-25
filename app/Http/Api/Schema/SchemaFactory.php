<?php

namespace App\Http\Api\Schema;

use Kentron\Service\Schema;

final class SchemaFactory
{
    public static function getSearchSchema(): string
    {
        return self::getSchema("Search", "Search");
    }

    /**
     * Private methods
     */

    private static function getSchema (string $actionPath, $schemaName): string
    {
        return Schema::get(__DIR__, $actionPath, $schemaName);
    }
}
