<?php
/**
 * Gestión de formulario
 * @author Javier Sánchez López
 * 
 */
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Primer Formulario</h1>
    <form action="procesa_form1.php" method="get">
        <label for="nombre">Nombre</label>
        <input type="text" name="name" value=""> <br/> <br/>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="surname" value=""> <br/> <br/>
        <input type="submit" name="send" value="Send"> 
    </form>
</body>
</html>