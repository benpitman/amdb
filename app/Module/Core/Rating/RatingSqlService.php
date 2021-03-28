<?php

namespace App\Module\Core\Rating;

use Illuminate\Database\Capsule\Manager;

final class RatingSqlService
{
    public static function bulkInsert(string $tsvPath): bool
    {
        return Manager::connection()->statement(
            "LOAD DATA LOCAL INFILE '$tsvPath' INTO TABLE `rating` FIELDS TERMINATED BY '\\t' LINES TERMINATED BY '\\n' IGNORE 1 LINES"
        );
    }
}
