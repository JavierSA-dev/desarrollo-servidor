<?php
include '../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Models\Equipo;
use App\Models\Perfil;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

session_start();

if(!isset($_SESSION['autorizar'])){
    $_SESSION['autorizar'] = false;
}

define('DBHOST', $_ENV['DB_HOST']);
define('DBNAME', $_ENV['DB_NAME']);
define('DBUSER', $_ENV['DB_USER']);
define('DBPASS', $_ENV['DB_PASS']);
define('DBPORT', $_ENV['DB_PORT']);

$equipo = Equipo::getInstancia();




$perfiles = $perfilClass->getPerfiles();

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
                <th>Fecha de Creación</th>
                <th>Fecha de Actualización</th>
            </thead>
            <tbody>
                <?php

                foreach($equipo->getAll() as $equipo) {
                    echo "<tr>";
                    echo "<td>" . $equipo['equipo'] . "</td>";
                    echo "<td>" . $equipo['created_at'] . "</td>";
                    echo "<td>" . $equipo['updated_at'] . "</td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>

</body>

</html>


