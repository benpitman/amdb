<?php

namespace App\Module\Core\System\Variable\Entity;

use Kentron\Entity\Template\AMapEntity;

final class VariableMapEntity extends AMapEntity
{
    private $name;
    private $value;
    private $type;
    private $encrypted;
    private $description;

    /**
     * Getters
     */

    public function getName (): string
    {
        return $this->name;
    }

    public function getValue ()
    {
        return $this->value;
    }

    public function getType (): string
    {
        return $this->type;
    }

    public function getEncrypted (): bool
    {
        return $this->encrypted;
    }

    public function getDescription (): ?string
    {
        return $this->description;
    }

    /**
     * Setters
     */

    public function setName (string $name): void
    {
        $this->name = $name;
    }

    public function setValue ($value): void
    {
        $this->value = $value;
    }

    public function setType (string $type): void
    {
        $this->type = $type;
    }

    public function setEncrypted (int $encrypted): void
    {
        $this->encrypted = (bool) $encrypted;
    }

    public function setDescription (string $description): void
    {
        $this->description = $description;
    }
}
