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

    static function validarCPF($cpf) {
        // Remove qualquer máscara de formatação como pontos e traços
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

}

