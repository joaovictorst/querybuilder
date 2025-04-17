<?php

namespace App\Utils;

class Utils {

    public static function formatValue($value) {

        if(is_null($value)) {
            return "NULL";
        }elseif(is_int($value) || is_float($value)){
            return $value;
        }elseif(is_bool($value)){
            return $value ? 'TRUE' : 'FALSE';
        }else {
            $value = str_replace("'", "''", $value);
            return "'{$value}'";
        }
    }
}