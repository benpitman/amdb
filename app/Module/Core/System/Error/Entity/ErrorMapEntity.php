<?php

namespace App\Module\Core\System\Error\Entity;

use Kentron\Entity\Template\AMapEntity;

final class ErrorMapEntity extends AMapEntity
{
    private $systemAuditID;
    private $text;

    /**
     * Getters
     */

    public function getSystemAuditID (): ?int
    {
        return $this->systemAuditID;
    }

    public function getText (): string
    {
        return $this->text;
    }

    /**
     * Setters
     */

    public function setSystemAuditID (?int $systemAuditID): void
    {
        $this->systemAuditID = $systemAuditID;
    }

    public function setText (string $text): void
    {
        $this->text = $text;
    }
}
