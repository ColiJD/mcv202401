<?php

namespace Dao\Pulseras;

use Dao\Table;

class Pulsera extends Table
{
    public static function getAllPulseras()
    {
        $sqlstr = 'SELECT * FROM pulseras;';

        return self::obtenerRegistros($sqlstr, []);
    }
}
