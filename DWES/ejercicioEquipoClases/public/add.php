<?php
require("../vendor/autoload.php");

use App\Models\DBAbstractModel;
use App\Models\Equipo;
use Dotenv\Dotenv;

session_start();
if (!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != "admin") {
    header("Location: index.php");
} else {
    $mensaje = "";
    $dotenv = Dotenv::createImmutable(__DIR__. "/../");
    $dotenv->load();

    define("DBHOST", $_ENV["DB_HOST"]);
    define("DBUSER",$_ENV["DB_USER"]) ;
    define("DBPASS",$_ENV["DB_PASSWD"]) ;
    define("DBNAME",$_ENV["DB_NAME"]) ;
    define("DBPORT",$_ENV["DB_PORT"]) ;
    $procesaFormulario = false;
    if (isset($_POST["add"])) {
        $procesaFormulario = true;
    }
    if (isset($_POST["enviar"])) {
        $objEquipo = Equipo::getInstancia();
        $objEquipo->setEquipo($_POST["nombre"]);
        $objEquipo->set();
       $mensaje = $objEquipo->getMensaje();
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
        <?php
        if ($procesaFormulario) {
        ?>
            <form action="" method="POST">
                <input type="text" name="nombre">
                <input type="submit" name="enviar" value="Añadir equipo">
            </form>
        <?php
        }
        ?>
        <p><?php echo $mensaje; ?></p>
        <form action="" method="POST">
            <input type="submit" name="inicio" value="Volver al inicio">
        </form>
    </body>

    </html>
<?php
}
?>