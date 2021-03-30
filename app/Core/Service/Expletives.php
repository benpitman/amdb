<?php

namespace App\Core\Service;

final class Expletives
{
    private static $rules =
        "\W("
        .   "[Aa][Nn][Aa][Ll]"
        .   "[Ff][Ii][Ss][Tt][Ii][Nn][Gg]"
        .   "[Pp][Rr][Oo][Ll][Aa][Pp][Ss][Ee]"
        .   "[Cc][Uu][Mm][Ss][Hh][Oo][Tt][Ss]?"
        .   "DAP"
    .   ")\W";

    public static function verify(string $check): bool
    {
        return !!preg_match(self::$rules, $check);
    }
}
