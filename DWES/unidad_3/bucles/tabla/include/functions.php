<?php

/**
 * Función que devuelve verdadero o falso si los datos están en el array
 */

function existeCoordenada($fila, $columna, $array) : bool {
    $siExiste = false;
    foreach ($array as $clave => $valor) {
        if ($valor['f'] == $fila and $valor['c'] == $columna) {
            $siExiste = true;
        }
    }
    return $siExiste;
}

?>