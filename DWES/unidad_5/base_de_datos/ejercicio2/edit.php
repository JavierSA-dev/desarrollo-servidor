<?php

include_once('config/config.php');
include_once('lib/functions.php');

$db = conectaDB();
session_start();

if ($_SESSION['profile'] != 'admin') {
    header('Location: index.php');
}

if (isset($_POST['edit'])) {
    editTeam($db, $_POST);
    header("Location: index.php");
    
}else{
    $oldTeam = getTeam($db, $_GET['id'])[0]['equipo'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Editar Equipo</title>
</head>
<body>
    <h1>Equipos</h1>
    <h2>Editar equipo</h2>
    <form action="" method="POST">
        <input type="text" name="equipo" value="<?php echo $oldTeam ?>">
        <input type="hidden" name="oldId" value="<?php echo $_GET['id']?>">
        <input type="submit" value="Editar" name="edit">
    </form>
    <button><a href="index.php">Cancelar</a></button>
</body>
</html>