<?php

namespace Utilities;

class Validators {

    static public function IsEmpty($valor)
    {
        return preg_match("/^\s*$/", $valor) && true;
    }

    static public function IsValidEmail($valor)
    {
        return preg_match("/^([a-z0-9_\.-]+\@[\da-z\.-]+\.[a-z\.]{2,6})$/", $valor) && true;
    }

    static public function IsValidPassword($valor){
        return preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,32}$/", $valor) && true;
    }

    // Método que valida si el valor es solo numérico
    static public function IsNumeric($valor)
    {
        return preg_match("/^\d+$/", $valor) && true;
    }

    // Método que valida si el valor tiene exactamente 8 dígitos
    static public function IsEightDigits($valor)
    {
        return preg_match("/^\d{8}$/", $valor) && true;
    }

    private function __construct()
    {
        
    }
    private function __clone()
    {
        
    }
}

?>
