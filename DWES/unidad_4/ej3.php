<?php

/**
 * Gestión de formulario
 * @author Javier Sánchez López
 * 
 */

$aDatosPersonales = array(
    array("Nombre", "text"),
    array("Apellidos", "text"),
    array("Curso", "text"),
    array("Color", "color"),
);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <h1>Formulario generado con PHP</h1>
    <form action='procesa_form3.php' method='post'>
        <?php
        foreach ($aDatosPersonales as $aDatos) {
            echo "<label for='$aDatos[0]'>$aDatos[0]</label><br/>";
            echo "<input type='$aDatos[1]' name='$aDatos[0]' value=''> <br/> <br/>";
        }
        ?>
        <input type='submit' name='send' value='Send'>
    </form>
</head>

<body>
</body>

</html>