<?php
/**
* Creación y contendio de un array
* @author Javier Sánchez López
*/ 

$contactos = array(
    array('id' => 1, 'nombre' => 'Mafalda', 'tlfno' => '666123123'),
    array('id' => 2, 'nombre' => 'Manolito', 'tlfno' => '674221100'),
);

$contactos2 = [["id"=>1,"nombre"=>"Mafalda","telefono"=>"666123123"],
 ["id"=>2,"nombre"=>"Manolito","telefono"=>"667422100"],
  ["id"=>3,"nombre"=>"Felipe","telefono"=>"668234233"]];


$ejercicio1 = array ("titulo" => "ej1",
"enlace" => "./unidad1/ej1.php",
"tags" => "ciclos, array",
"fecha" => "05/10/2022");


$ejerciciosTema1 = array($ejercicio1,$ejercicio2,$ejercicio3);


$ejercicios = array($ejerciciosTema1,$ejerciciosTema2);


// foreach ($contactos as $key1 => $value1) {
//     foreach ($value1 as $key2 => $value2) {
//         echo $value2, ' ';
//     }
//     echo "<br>";
// }

// foreach ($contactos as $key3 => $value3) {
//     echo $key3;
//     echo "<br>";
// }

?>