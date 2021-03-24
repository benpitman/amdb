<?php

namespace App\Core\Store;

use Kentron\Store\IStore;

final class Local implements IStore
{
    public static function reset(bool $hard = false): void {}
}
