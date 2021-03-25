<?php

namespace App\Module\Core\TitleType\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class TitleTypeCollectionEntity extends ACollectionEntity
{
    public function __construct()
    {
        parent::__construct(TitleTypeMapEntity::class);
    }

    public function getIdByText(string $text): ?int
    {
        /** @var TitleTypeMapEntity */
        foreach ($this->iterateEntities() as $titleTypeMapEntity) {
            if ($titleTypeMapEntity->getText() === strtoupper($text)) {
                return $titleTypeMapEntity->getID();
            }
        }

        return null;
    }
}
