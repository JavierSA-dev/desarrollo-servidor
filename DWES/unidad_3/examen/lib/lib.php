<?php

include "../config/config.php";

// Proceso aleatorio que cargue en un array las localidades ocupadas por los socios
$aLocalidades = array();
function loadPrices(){
    for ($i=0; $i < ABONOS; $i++) { 
        $aLocalidades[$i] = rand(1,400);
    }
    return $aLocalidades;
};


?>