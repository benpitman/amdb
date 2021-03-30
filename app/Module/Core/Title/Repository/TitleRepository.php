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

    public function whereTitleType(string $titleTypeId): void
    {
        parent::where("title_title_type_id", $titleTypeId);
    }

    public function whereDateCreatedGreaterThan (DT $date): void
    {
        parent::where("title_start_year", $date, ">");
    }

    public function whereDateCreatedLessThan (DT $date): void
    {
        parent::where("title_start_year", $date, "<");
    }

    public function whereTitle (string $contains): void
    {
        parent::whereRaw("MATCH (title_primary, title_original) AGAINST ('{$contains}')");
    }

    public function updateDescription(string $description): void
    {
        parent::addUpdate("title_description", $description);
    }
}
