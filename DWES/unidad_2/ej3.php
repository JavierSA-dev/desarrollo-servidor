<?php
/* Script que, a partir del radio almacenado en una variable y la definición de la constante PI, calcule el
área del círculo y la longitud de la circunferencia. El debe mostrar valor de radio, longitud de la
circunferencia, área del círculo y dibujará un círculo utilizando gráficos vectoriales.
@author Javier Sánchez López
*/

$radio = 10;
define('PI', pi()); 

$area = PI * $radio**2;
$circunferencia  = 2 * PI * $radio;

echo "El radio es: " .$radio."<br/>";
echo "El area es: " .$area ."<br/>";
echo "La circunferencia es: " .$circunferencia;
echo 
"<svg viewBox=\"0 0 120 40\" version=\"1.1\"
xmlns=\"http://www.w3.org/2000/svg\">
<circle cx=\"60\" cy=\"20\" r=\"".$radio."\"/>
</svg>"

?>

<a href="https://github.com/JavierSA-dev/Desarrollo-Web-en-Entorno-Servidor/blob/main/Unidad2/ej3.php" target="_blank" >Ir al repositorio</a>