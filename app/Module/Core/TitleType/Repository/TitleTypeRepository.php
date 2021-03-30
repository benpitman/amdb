<?php

namespace App\Module\Core\TitleType\Repository;

use Kentron\Template\ARepository;

final class TitleTypeRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\TitleType::class;

    public function whereId(int $typeId): void
    {
        parent::where("title_type_id", $typeId);
    }
}
