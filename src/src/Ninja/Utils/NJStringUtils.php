<?php

namespace Ninja\Utils;

class NJStringUtils
{
    public static function truncate($string, $length = 100, $append = "&hellip;"): string
    {
        $string = trim($string);

        if (strlen($string) > $length) {
            $string = wordwrap($string, $length);
            $string = explode("\n", $string, 2);
            $string = $string[0] . $append;
        }

        return $string;
    }
}
