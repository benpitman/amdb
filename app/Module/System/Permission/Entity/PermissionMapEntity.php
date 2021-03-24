<?php

namespace App\Module\System\Permission\Entity;

use Kentron\Entity\Template\AMapEntity;

final class PermissionMapEntity extends AMapEntity
{
    private $bit;
    private $constant;

    public function getBit (): int
    {
        return $this->bit;
    }

    public function getConstant (): string
    {
        return $this->constant;
    }

    public function setBit (int $bit): void
    {
        $this->bit = $bit;
    }

    public function setConstant (string $constant): void
    {
        $this->constant = $constant;
    }
}
