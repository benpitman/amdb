<?php

namespace App\Module\Core\Type\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class TypeCollectionEntity extends ACollectionEntity
{
    public function __construct()
    {
        parent::__construct(TypeMapEntity::class);
    }

    public function getIdByText(string $text): ?int
    {
        /** @var TypeMapEntity */
        foreach ($this->iterateEntities() as $typeMapEntity) {
            if ($typeMapEntity->getStandardised() === $this->standardise($text)) {
                return $typeMapEntity->getID();
            }
        }

        return null;
    }

    private function standardise (string $text): string
    {
        return strtoupper(preg_replace('/(?<!^)[A-Z]/', '_$0', $text));
    }
}
