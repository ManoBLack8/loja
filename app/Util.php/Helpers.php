<?php
namespace App\Util;

class Helpers {
    public static function TratarCaracterEspecial($input) {
        return htmlspecialchars(strip_tags($input));
    }

    public static function formatarMoeda($value) {
        return number_format($value, 2, ',', '.');
    }
}
