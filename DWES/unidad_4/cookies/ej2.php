<?php

/**
 * Escriba una página que compruebe si el navegador permite crear cookies y se lo diga al usuario
 * (mediante una o más páginas).
 * @author Javier Sánchez López
 */

setcookie('usuario', 'javier', time()+3600);
header("location: check.php");


?>