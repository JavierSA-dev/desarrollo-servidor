<?php
/**
 * @author: Javier Sánchez López
 */
include "../config/config.php";

function loadPrices(){
    for ($i=0; $i < ABONOS; $i++) { 
        $aLocalidades[$i] = rand(1,400);
    }
    return $aLocalidades;
};


?>