<?php

namespace App\Module\Core\System\Cron\Entity;

use Kentron\Entity\Template\AEntity;

use App\Core\Entity\SimpleException;

use \Exception;

final class CronEntity extends AEntity
{
    private $args = [];
    private $method;
    private $instance;
    private $startTime;
    private $endTime;
    private $exception;
    private $response;

    public function __construct ()
    {
        $this->setStartTime();
    }

    /**
     * Getters
     */

    public function getMethod (): string
    {
        return $this->method;
    }

    public function getArgs (): array
    {
        return $this->args;
    }

    public function getTimeTaken (): float
    {
        return $this->timeTaken;
    }

    public function getException (): ?SimpleException
    {
        return $this->exception;
    }

    public function getResponse (): ?string
    {
        if ($this->hasErrors()) {
            return json_encode($this->getErrors());
        }
        if ($this->hasException()) {
            return $this->exception->getPretty();
        }

        return $this->response;
    }

    /**
     * Setters
     */

    public function setMethod (string $method): void
    {
        $this->method = $method;
    }

    public function setArgs (array $args): void
    {
        $this->args = $args;
    }

    public function setStartTime (?float $startTime = null): void
    {
        $this->startTime = $startTime ?? microtime(true);
    }

    public function setEndTime (?float $endTime = null): void
    {
        $this->endTime = $endTime ?? microtime(true);
    }

    public function setTimeTaken (): void
    {
        $this->timeTaken = $this->endTime - $this->startTime;
    }

    public function setException (Exception $exception): void
    {
        $this->exception = new SimpleException($exception);
    }

    public function setResponse (?string $response = null): void
    {
        $this->response = $response;
    }

    /**
     * Helpers
     */

    public function end (): void
    {
        $this->setEndTime();
        $this->setTimeTaken($this->endTime - $this->startTime);
    }

    public function hasException (): bool
    {
        return !!$this->exception;
    }

    public function hasFailed (): bool
    {
        return ($this->hasErrors() || $this->hasException());
    }

    public function callMethod (): bool
    {
        $method = $this->method;

        try {
            $entity = $this->instance->$method(...$this->getArgs());
        }
        catch (Exception $ex) {
            $this->setException($ex);
            return false;
        }
        finally {
            $this->end();
        }

        if ($entity->hasErrors()) {
            $this->addError($entity->getErrors());
            return false;
        }

        return true;
    }

}
