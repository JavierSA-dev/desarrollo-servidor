<?php
/* Almacena tres números en variables y escribirlos en pantalla de manera ordenada.
@author Javier Sánchez López
*/

$x=10;
$y=7;
$z=5;

if ($x > $y && $x > $z) {
    if ($y > $z) {
        echo $x, $y, $z;
    }else{
        echo $x, $z, $y;
    }
}elseif ($y > $z && $y > $x) {
    if ($z > $x) {
        echo $y, $z, $x;
    }else{
        echo $y, $x, $z;
    }

}else {
    if ($x > $y) {
        echo $z, $x, $y;
    }else{
        echo $z, $y, $z;
    }
}


?>

<a href="https://github.com/JavierSA-dev/Desarrollo-Web-en-Entorno-Servidor/blob/master/unidad_3/ej1.php" target="_blank" >Ir al repositorio</a>