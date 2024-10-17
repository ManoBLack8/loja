<?php
namespace App\Util;

class Helpers {
    public static function TratarCaracterEspecial($input) {
        return htmlspecialchars(strip_tags($input));
    }

    public static function formatarMoeda($value) {
        if(isset($value)){
           return number_format($value, 2, ',', '.'); 
        }
        return number_format(0, 2, ',', '.');
    }
}
