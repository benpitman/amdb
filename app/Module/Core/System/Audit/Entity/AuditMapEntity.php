<?php

namespace App\Module\Core\System\Audit\Entity;

use Kentron\Entity\Template\AMapEntity;

use Kentron\Facade\DT;

final class AuditMapEntity extends AMapEntity
{
    private $authID;
    private $userDeviceID;
    private $direction;
    private $route;
    private $method;
    private $requestBody;
    private $responseBody;
    private $statusCode;
    private $duration;

    /**
     * Getters
     */

    public function getAuthID (): ?int
    {
        return $this->authID;
    }

    public function getUserDeviceID (): ?int
    {
        return $this->userDeviceID;
    }

    public function getDirection (): string
    {
        return $this->direction;
    }

    public function getRoute (): string
    {
        return $this->route;
    }

    public function getMethod (): ?string
    {
        return $this->method;
    }

    public function getRequestBody (): ?string
    {
        return $this->requestBody;
    }

    public function getResponseBody (): ?string
    {
        return $this->responseBody;
    }

    public function getStatusCode (): ?int
    {
        return $this->statusCode;
    }

    public function getDuration (): ?DT
    {
        return $this->duration;
    }

    /**
     * Setters
     */

    public function setAuthID (?int $authID): void
    {
        $this->authID = $authID;
    }

    public function setUserDeviceID (?int $userDeviceID): void
    {
        $this->userDeviceID = $userDeviceID;
    }

    public function setDirection (string $direction): void
    {
        $this->direction = $direction;
    }

    public function setRoute (string $route): void
    {
        $this->route = $route;
    }

    public function setMethod (?string $method): void
    {
        $this->method = $method;
    }

    public function setRequestBody (?string $requestBody): void
    {
        $this->requestBody = $requestBody;
    }

    public function setResponseBody (?string $responseBody): void
    {
        $this->responseBody = $responseBody;
    }

    public function setStatusCode (?int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    public function setDuration (?string $duration): void
    {
        if (is_string($duration)) {
            $this->duration = DT::then($duration);
        }
    }

    /**
     * Helpers
     */

    public function setInbound (): void
    {
        $this->setDirection("INBOUND");
    }

    public function setOutbound (): void
    {
        $this->setDirection("OUTBOUND");
    }
}
