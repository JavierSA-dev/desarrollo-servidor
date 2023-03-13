<?php
require("../vendor/autoload.php");

use App\Models\Equipo;
use Dotenv\Dotenv;

session_start();
if (!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != "admin") {
    header("Location: index.php");
} else {
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();

    define("DBHOST", $_ENV["DB_HOST"]);
    define("DBUSER", $_ENV["DB_USER"]);
    define("DBPASS", $_ENV["DB_PASSWD"]);
    define("DBNAME", $_ENV["DB_NAME"]);
    define("DBPORT", $_ENV["DB_PORT"]);
    $id = $_GET["id"];
    $ObjEquipo = Equipo::getInstancia();
    $equipo = $ObjEquipo->getEquipoById($id);
    if (isset($_POST["enviar"])) {
        // Limpiar datos enviados a la base de datos
        $ObjEquipo->edit($_POST);
        header("Location: index.php");
    }

    if (isset($_POST["inicio"])) {
        header("Location: index.php");
    }
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
        <h1>CB_POKEMONS</h1>
        <form action="" method="POST">

            <?php
            foreach ($equipo as $key => $value) {
                echo "Nombre nuevo a poner <input type=\"text\" name=\"equipo\" value=\"$value[equipo]\">";
            }

            echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
            ?>

            <input type="submit" name="enviar" value="Confirmar nombre">
        </form>
        <form action="" method="POST">
            <input type="submit" name="inicio" value="Volver al inicio">
        </form>
    </body>

    </html>
<?php
}

?>