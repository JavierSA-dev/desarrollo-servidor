<?php
/**
* Crear un array con los alumnos de clase y permitir la selección aleatoria de uno de ellos. El resultado
* debe mostrar nombre y fotografía.
* @author Javier Sánchez López
*/ 

$aLumnos = array(
    array('nombre' => 'Javier', 'foto' => 'javier.jpg'),
    array('nombre' => 'Manolito', 'foto' => 'manolito.jpg'),
    array('nombre' => 'Felipe', 'foto' => 'felipe.jpg'),
    array('nombre' => 'Mafalda', 'foto' => 'mafalda.jpg'),
    array('nombre' => 'Paco', 'foto' => 'paco.jpg')

);

echo "<h1>Alumnos aleatorio</h1>";
$randomNumber = rand(0, (count($aLumnos)-1));

echo 'Nombre: ' .$aLumnos[$randomNumber]['nombre'];
echo "</br>";
echo "</br>";
echo 'Foto: ' .$aLumnos[$randomNumber]['foto'];

?>