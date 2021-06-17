<?php

namespace App\Helpers;

class Helper
{
    /***
     * @param $mask
     * @param $str
     * @return mixed
     */
     static function mask($mask,$str) {

        $str = str_replace([" ",".",",","-","/"],"",$str);

        for($i=0;$i<strlen($str);$i++) {
            $mask[strpos($mask,"#")] = $str[$i];
        }

        return $mask;
    }

    /***
     * @param array $array
     * @param callable $callback
     * @return array|false
     */
    static function array_convert_key_case(array $array, callable $callback)
    {
        return array_combine(
            array_map($callback, array_keys($array)),
            array_values($array)
        );
    }
}
