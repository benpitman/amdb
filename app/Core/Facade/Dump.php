<?php

namespace App\Core\Facade;

use Spiral\Debug\Dumper;
use Spiral\Debug\Renderer\ConsoleRenderer;

final class Dump
{
    /**
     * @var Dumper
     */
    private static $dumper;

    public static function out($var): void
    {
        self::$dumper ?? self::init();

        self::$dumper->dump($var, Dumper::ERROR_LOG);
    }

    private static function init(): void
    {
        self::$dumper = new Dumper();
        self::$dumper->setRenderer(Dumper::ERROR_LOG, new ConsoleRenderer());
    }
}
