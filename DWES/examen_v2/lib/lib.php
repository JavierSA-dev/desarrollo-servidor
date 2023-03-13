<?php
/**
 * @author: Javier Sánchez López
 */
include "../config/config.php";

function generarAbonos(){
    $aAbonados = array();
    for ($i = 0; $i < NABONOS; $i++) {
        do {
            $num = rand(1, AFORO);
        } while (in_array($num, $aAbonados));
        $aAbonados[] = $num;
        
    }
    return $aAbonados;
}

?>