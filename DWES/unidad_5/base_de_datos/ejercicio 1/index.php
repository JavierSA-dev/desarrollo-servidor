<?php
include_once('config/config.php');
include_once('lib/functions.php');

$db = conectaDB();

// consulta de los equipos
$sql = "SELECT * FROM equipos";
$resultado = $db -> query($sql);
foreach ($resultado as $value) {
    echo "Id: ".$value['id'] ." ";
    echo "<br>";
    echo "Equipo: " .$value['equipo'];
    echo "<br>";
}

// // Borrar todos los equipos
// $sql2 = "DELETE FROM equipos";
// $resultado2 = $db -> query($sql2);

// insertar equipos
// $sql3 = "insert into equipos (equipo) VALUES('Jose Lui2'),('maria');";
// $resultado3 = $db -> query($sql3);

?>

