<?php

namespace App\Module\Core\System\Variable;

use App\Module\Core\Entity\Database\System\Variable\VariableDBCollectionEntity;

use App\Module\Core\System\Variable\Repository\VariableRepository;

final class VariableSqlService
{
    public static function getAll (): VariableDBCollectionEntity
    {
        $variableDBCollectionEntity = new VariableDBCollectionEntity();
        $systemVarRepository = new VariableRepository();

        $systemVarRepository->buildAll($variableDBCollectionEntity);

        return $variableDBCollectionEntity;
    }
}
