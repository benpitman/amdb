<?php

namespace App\Module\Core\TitleRating;

use Illuminate\Database\Capsule\Manager;

final class TitleRatingSqlService
{
    public static function bulkInsert(string $tsvPath): bool
    {
        return Manager::connection()->statement(
            "LOAD DATA LOCAL INFILE '$tsvPath' INTO TABLE `title_rating` FIELDS TERMINATED BY '\\t' LINES TERMINATED BY '\\n' IGNORE 1 LINES"
        );
    }
}
