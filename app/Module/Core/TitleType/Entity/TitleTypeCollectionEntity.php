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
            if ($titleTypeMapEntity->getStandardised() === $this->standardise($text)) {
                return $titleTypeMapEntity->getID();
            }
        }

        return null;
    }

    private function standardise (string $text): string
    {
        return strtoupper(str_replace([" ", "-"], "_", preg_replace("/[^[:alpha:][ -]]/", "", $text)));
    }
}
