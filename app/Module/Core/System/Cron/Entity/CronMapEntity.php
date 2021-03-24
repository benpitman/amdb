<?php

namespace App\Module\Core\System\Cron\Entity;

use Kentron\Entity\Template\AMapEntity;
use Kentron\Facade\DT;

final class CronMapEntity extends AMapEntity
{
    private $providerID;
    private $class;
    private $method;
    private $args;
    private $interval;
    private $dateRan;

    /**
     * Getters
     */

    public function getProviderID (): ?int
    {
        return $this->providerID;
    }

    public function getClass (): ?string
    {
        return $this->class;
    }

    public function getMethod (): string
    {
        return $this->method;
    }

    public function getArgs (): array
    {
        return $this->args;
    }

    public function getInterval (): int
    {
        return $this->interval;
    }

    public function getDateRan (): DT
    {
        return $this->dateRan;
    }

    /**
     * Setters
     */

    public function setProviderID (?int $providerID): void
    {
        $this->providerID = $providerID;
    }

    public function setClass (?string $class): void
    {
        $this->class = $class;
    }

    public function setMethod (string $method): void
    {
        $this->method = $method;
    }

    public function setArgs (?string $args): void
    {
        $this->args = json_decode($args) ?? [];
    }

    public function setInterval (int $interval): void
    {
        $this->interval = $interval;
    }

    public function setDateRan (?string $dateRan = null): void
    {
        if (is_string($dateRan)) {
            $this->dateRan = DT::then($dateRan);
        }
    }

    /**
     * Helpers
     */

    public function canRun (): bool
    {
        if (is_null($this->dateRan)) {
            return true;
        }

        $dtNextRunAt = DT::then($this->dateRan->format())->increment($this->interval);

        return DT::now()->format() >= $dtNextRunAt->format();
    }
}
