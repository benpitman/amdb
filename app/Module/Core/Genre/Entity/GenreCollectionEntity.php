<?php

namespace App\Module\Core\Genre\Entity;

use Kentron\Entity\Template\ACollectionEntity;

final class GenreCollectionEntity extends ACollectionEntity
{
    public function __construct()
    {
        parent::__construct(GenreMapEntity::class);
    }

    public function getIdByText(string $text): ?int
    {
        /** @var GenreMapEntity */
        foreach ($this->iterateEntities() as $genreMapEntity) {
            if ($genreMapEntity->getStandardised() === $this->standardise($text)) {
                return $genreMapEntity->getID();
            }
        }

        return null;
    }

    private function standardise (string $text): string
    {
        return strtoupper(str_replace(" ", "_", preg_replace("/[^[:alpha:] ]/", "", $text)));
    }
}
