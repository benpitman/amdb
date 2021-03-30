<?php

namespace App\Module\Api\Entity;

use App\Module\Api\Entity\Title\TitleApiCollectionEntity;
use Kentron\Entity\Template\AEntity;

final class SearchResponseEntity extends AEntity
{
    /**
     * @var TitleApiCollectionEntity
     */
    private $titleApiCollectionEntity;

    public function setTitleApiCollectionEntity(TitleApiCollectionEntity $titleApiCollectionEntity): void
    {
        $this->titleApiCollectionEntity = $titleApiCollectionEntity;
    }

    public function getTitleApiCollectionEntity(): TitleApiCollectionEntity
    {
        return $this->titleApiCollectionEntity;
    }
}
