<?php
require("../vendor/autoload.php");

use App\Models\DBAbstractModel;
use App\Models\Bookmark;
use Dotenv\Dotenv;

session_start();
if ($_SESSION["perfil"] != "user") {
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
    $procesaFormulario = true;

    if (isset($_POST["enviar"])) {
        $objBookmark = Bookmark::getInstancia();
        $objBookmark->add($_POST);

       $mensaje = $objBookmark->getMensaje();
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
        <h1>Añadir</h1>
        <?php
        if ($procesaFormulario) {
        ?>
            <form action="" method="POST">
                <!-- hidden -->
                <input type="hidden" name="idUsuario" value="<?php echo $_GET['idUsuario'] ?>">
                <input type="text" name="bm_url" placeholder="Url"><br><br>
                <textarea type="text" name="descripcion" placeholder="Descripcion"></textarea><br>
                <input type="submit" name="enviar" value="Añadir Bookmark">
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