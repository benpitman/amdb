<?php

namespace App\Core\Entity;

final class SimpleException
{
    private $file;
    private $line;
    private $message;
    private $trace;

    public function __construct (\Exception $exception)
    {
        $this->file = $exception->getFile();
        $this->line = $exception->getLine();
        $this->message = $exception->getMessage();
        $this->trace = $exception->getTraceAsString();
    }

    public function getFile (): string
    {
        return $this->file;
    }

    public function getLine (): int
    {
        return $this->line;
    }

    public function getMessage (): string
    {
        return $this->message;
    }

    public function getTrace (): string
    {
        return $this->trace;
    }

    public function getPretty (): string
    {
        return "{$this->file} ({$this->line}): {$this->message}\n{$this->trace}";
    }
}
