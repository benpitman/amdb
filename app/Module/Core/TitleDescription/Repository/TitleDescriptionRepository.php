<?php

namespace App\Module\Core\TitleDescription\Repository;

use Kentron\Template\ARepository;

final class TitleDescriptionRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\TitleDescription::class;

    public function whereImdbId(string $imdb): void
    {
        parent::where("title_description_imdb_id", $imdb);
    }
}
