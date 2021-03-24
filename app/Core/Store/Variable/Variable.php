<?php

namespace App\Core\Store\Variable;

use Kentron\Store\Variable\AVariable;

final class Variable extends AVariable
{
    /**
     * Getters
     */

    public static function getSystemName (): string
    {
        return parent::get(2);
    }

    public static function getSystemAccess (): bool
    {
        return parent::get(3) ?? false;
    }

    public static function getDefaultDateTimeFormat (): string
    {
        return parent::get(4);
    }

    public static function getEmailSMTP (): string
    {
        return parent::get(5);
    }

    public static function getEmailPort (): int
    {
        return parent::get(6);
    }

    public static function getEmailMethod (): string
    {
        return parent::get(7);
    }

    public static function getEmailUsername (): string
    {
        return parent::get(8);
    }

    public static function getEmailPassword (): string
    {
        return parent::get(9);
    }

    public static function getEmailDefaultFrom (): string
    {
        return parent::get(10);
    }
}
