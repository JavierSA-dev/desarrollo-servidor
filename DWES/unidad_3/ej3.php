<?php
/* Carga fecha de nacimiento en variables y calcula la edad.
@author Javier Sánchez López
*/

$fecha = "27/08/2003";
$dia = substr($fecha,0,2);
$month = substr($fecha,3,2);
$year = substr($fecha,6,10);

$edad = date("Y") - $year;
if (date("m") < $month) {
  $edad--;
} else if (date("m") == $month && date("d") < $dia) {
  $edad--;
}
echo 'Si naciste el '.$fecha .' tienes ' .$edad .' años.';


?>

<a href="https://github.com/JavierSA-dev/Desarrollo-Web-en-Entorno-Servidor/blob/master/unidad_3/ej1.php" target="_blank" >Ir al repositorio</a>