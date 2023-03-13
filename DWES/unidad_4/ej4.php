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
    <h1>Formulario generado con PHP</h1>
    <form action='procesa_form3.php' method='post'>
        <label for="file">Archivo</label> <br>
        <input type="file" name="file"><br><br>
        <label for="url">Url</label> <br>
        <input type="url" name="url"><br><br>
        <input type='submit' name='send' value='Send'>

    </form>
</head>

<body>
</body>

</html>