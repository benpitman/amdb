<?php

namespace App\Module\Core\Title\Repository;

use Kentron\Facade\DT;
use Kentron\Template\ARepository;

final class TitleRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\Title::class;

    public function whereImdbId(string $imdbId): void
    {
        parent::where("title_imdb_id", $imdbId);
    }

    public function whereType(string $typeId): void
    {
        parent::where("title_type_id", $typeId);
    }

    public function whereDateCreatedGreaterThan (DT $date): void
    {
        parent::where("title_start_year", $date, ">");
    }

    public function whereDateCreatedLessThan (DT $date): void
    {
        parent::where("title_start_year", $date, "<");
    }

    /**
     * @param string[] $titles
     *
     * @return void
     */
    public function whereTitle (array $titles): void
    {
        $contains = "+" . implode(" +", $titles);
        parent::whereRaw(
            <<<SQL
                MATCH (title_primary, title_original) AGAINST ('{$contains}' IN BOOLEAN MODE)
            SQL
        );
    }

    /**
     * @param string[] $titles
     *
     * @return void
     */
    public function orderByDefault (array $titles): void
    {
        $length = array_walk($titles, fn (string $title) => strlen($title));

        parent::orderByRaw(
            <<<SQL
                ABS( {$length} - LENGTH(title_primary) ),
                title_primary,
                title_start_year DESC
            SQL
        );
    }

    public function updateDescription(string $description): void
    {
        parent::addUpdate("title_description", $description);
    }
}
