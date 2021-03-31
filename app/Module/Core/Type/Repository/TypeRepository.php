<?php

namespace App\Module\Core\Type\Repository;

use Kentron\Template\ARepository;

final class TypeRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\Type::class;

    public function whereId(int $typeId): void
    {
        parent::where("type_id", $typeId);
    }
}
