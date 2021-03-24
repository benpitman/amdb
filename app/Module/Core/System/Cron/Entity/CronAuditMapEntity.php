<?php

namespace App\Module\Core\System\Cron\Entity;

use Kentron\Entity\Template\AMapEntity;

final class CronAuditMapEntity extends AMapEntity
{
    private $cronID;
    private $successful;
    private $response;
    private $duration;

    /**
     * Getters
     */

    public function getCronID (): int
    {
        return $this->cronID;
    }

    public function getSuccessful (): bool
    {
        return $this->successful;
    }

    public function getResponse (): ?string
    {
        return $this->response;
    }

    public function getDuration (): float
    {
        return $this->duration;
    }

    /**
     * Setters
     */

    public function setCronID (int $cronID): void
    {
        $this->cronID = $cronID;
    }

    public function setSuccessful (bool $successful = true): void
    {
        $this->successful = $successful;
    }

    public function setResponse (?string $response = null): void
    {
        $this->response = $response;
    }

    public function setDuration (float $duration): void
    {
        $this->duration = $duration;
    }
}
