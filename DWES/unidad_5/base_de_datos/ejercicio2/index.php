<?php

include_once('config/config.php');
include_once('lib/functions.php');
$db = conectaDB();
$path = "";
$autorizar = false;
$mesError = "";
session_start();

if (!isset($_SESSION['profile'])) {
    $_SESSION['profile'] = 'invitado';
}

if (isset($_POST['send'])) {
    $path = $_POST['path'];
    $data = getFilteredData($db, $_POST['path']);
}else{
    $data = getAll($db);
}

if($_SESSION['profile'] == 'admin'){
    $autorizar = true;
}

if (isset($_POST['credentials'])) {
    if ($_POST['user'] == getAuthorizedUsers($db)[0]['usuario'] && $_POST['password'] == getAuthorizedUsers($db)[0]['pass']) {
        $autorizar = true;
        $_SESSION['name'] = getAuthorizedUsers($db)[0]['nombre'];
        $_SESSION['profile'] = getAuthorizedUsers($db)[0]['perfil'];
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['password'] = $_POST['password'];
    }else{
        $mesError = "Usuario o contraseña incorrectos";
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
    <title>Baloncesto Pokemon</title>
</head>

<body>
    <h1>Equipos</h1>
    <?php

    if ($autorizar) {
        echo "<h2>Bienvenido " . $_SESSION['name'] . "</h2>";
        echo "<h3>Te has registrado como: " . $_SESSION['profile'] . "</h3>";
        echo "<a href='logout.php'>Cerrar sesión</a>";
    } else {
        echo $mesError;
    ?>
        <form action="" method="post">
            <label for="user">Usuario</label>
            <input type="text" name="user" id="user"><br><br>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password"><br><br>
            <input type="submit" value="Enviar" name="credentials">
        </form>
        <?php

        }
        ?>
        <h2>Listado de Equipos</h2>
        <form action="" method="POST">
            <input type="text" name="path" value="<?php echo $path ?>" placeholder="buscar">
            <input type="submit" value="Buscar" name="send">
        </form>
        <?php

        if ($autorizar) {
            echo "<a id=\"add\" href=\"add.php\">Añadir</a>";
        } 

        ?>
        <table>
            <thead>
                <th>Nombre</th>
            </thead>
            <tbody>
                <?php
                foreach ($data as $key => $value) {
                    echo "<tr>";
                    if ($autorizar) {
                        echo "<td>" . $value['equipo'] . " </td><td><a id='edit' href=edit.php?id=" . $value['id'] . ">editar</a></td><td> <a id='borrar' href=remove.php?id=" . $value['id'] . ">borrar</a> </td>";
                        echo "</tr>";
                    } else {
                        echo "<td>" . $value['equipo'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

</body>

</html>