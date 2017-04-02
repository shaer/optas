<?php

namespace App\Helpers;

class Helper
{
    public static function tokenize($string)
    {
        return trim(strtolower(str_replace(" ", "_", $string)));
    }
}