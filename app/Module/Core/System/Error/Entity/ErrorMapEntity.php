<?php

namespace App\Module\Core\System\Error\Entity;

use Kentron\Entity\Template\AMapEntity;

final class ErrorMapEntity extends AMapEntity
{
    private $auditID;
    private $text;

    /**
     * Getters
     */

    public function getAuditID (): ?int
    {
        return $this->auditID;
    }

    public function getText (): string
    {
        return $this->text;
    }

    /**
     * Setters
     */

    public function setAuditID (?int $auditID): void
    {
        $this->auditID = $auditID;
    }

    public function setText (string $text): void
    {
        $this->text = $text;
    }
}
