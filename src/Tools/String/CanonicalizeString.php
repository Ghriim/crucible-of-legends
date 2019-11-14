<?php

namespace App\Tools\String;

class CanonicalizeString
{
    public static function canonicalize(string $string): string
    {
        $toLowerCase = strtolower($string);
        $removeSpace = str_replace(' ', '-', $toLowerCase);

        return htmlentities($removeSpace);
    }
}