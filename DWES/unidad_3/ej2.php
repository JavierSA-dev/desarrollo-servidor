<?php
/* Carga en variables mes y año e indica el número de días del mes. Utiliza la estructura de control switch
@author Javier Sánchez López
*/

$year = 1992;
$month = 12;
$dias = 0;

switch ($month) {
    case 2:
        if ($year % 4 == 0) {
            $dias = 29;
        }else{
            $dias = 28;
        }
        break;
    case 1:
    case 3:
    case 5:
    case 7:
    case 8:
    case 10:
    case 12:
        $dias = 31;
        break;
    default:
        $dias = 30;
        break;
};

echo "El mes " .$month ." tiene " .$dias;

?>

<a href="https://github.com/JavierSA-dev/Desarrollo-Web-en-Entorno-Servidor/blob/master/unidad_3/ej1.php" target="_blank" >Ir al repositorio</a>