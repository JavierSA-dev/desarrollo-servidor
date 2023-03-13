

<?php 
/**
 * Escriba una página que permita crear una cookie de duración limitada, comprobar el estado de la
 * cookie y destruirla. 
 * @author Javier Sánchez López
 */


    date_default_timezone_set("Europe/Madrid");
    setcookie('last-time', date('d/m/Y H:i:s'), time() + 3600);
    print_r($_COOKIE);
    // setcookie('last-time', '', time() - 3600); Si descomentamos esta línea, la cookie se destruye

?>