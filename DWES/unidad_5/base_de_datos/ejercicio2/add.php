<?php

include_once('config/config.php');
include_once('lib/functions.php');

$db = conectaDB();

session_start();


if ($_SESSION['profile'] != 'admin') {
    header('Location: index.php');
}
if (isset($_POST['send'])) {
    if (addTeam($db, $_POST)) {
        header('Location: index.php');
    }else{
        echo "Error al introducir el usuario";
    }
    
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Añadir Equipo</title>
</head>
<body>
    <h1>Equipos</h1>
    <h2>Añadir Equipo</h2>
    <form action="" method="POST">
        <input type="text" name="equipo" placeholder="Nombre del equipo">
        <input type="submit" name="send" value="Añadir">
    </form>
    <button><a href="index.php">Cancelar</a></button>
</body>
</html>