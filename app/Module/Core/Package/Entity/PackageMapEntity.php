<?php

namespace App\Module\Core\Package\Entity;

use App\Module\Core\Imdb\Template\ADataset;
use Kentron\Entity\Template\AMapEntity;

final class PackageMapEntity extends AMapEntity
{
    private $classPath;
    private $uri;
    private $putName;

    /**
     * Setters
     */

    public function setClassPath(string $classPath): void
    {
        $this->classPath = $classPath;
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    public function setPutName(string $putName): void
    {
        $this->putName = $putName;
    }

    /**
     * Getters
     */

    public function getClassPath(): string
    {
        return $this->classPath;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getPutName(): string
    {
        return $this->getPutName;
    }

    /**
     * Helpers
     */

    public function getNewClass (): ADataset
    {
        $classPath = $this->classPath;
        return new $classPath();
    }
}
