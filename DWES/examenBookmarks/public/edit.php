<?php
require("../vendor/autoload.php");

use App\Models\Bookmark;
use Dotenv\Dotenv;

session_start();
if ($_SESSION["perfil"] != "user" ) {
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
    $ObjBookmark = Bookmark::getInstancia();
    $bookmark = $ObjBookmark->getBookmarkByid($id);

    if ($_SESSION["user"][0]["id"]!= $bookmark[0]["idUsuario"]) {
        header("Location: index.php");
    }
    if (isset($_POST["enviar"])) {
        $ObjBookmark->edit($_POST);
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
        <h1>Editar</h1>
        <form action="" method="POST">

            <?php
            foreach ($bookmark as $key => $value) {
                echo "<input type=\"text\" name=bm_url value=\"$value[bm_url]\">";
                echo "<input type=\"text\" name=descripcion value=\"$value[descripcion]\">";
            }

            echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
            echo "<input type=\"hidden\" name=\"idUsuario\" value=\"$value[idUsuario]\">";
            ?>

            <input type="submit" name="enviar" value="Confirmar cambios">
        </form>
        <form action="" method="POST">
            <input type="submit" name="inicio" value="Volver al inicio">
        </form>
    </body>

    </html>
<?php
}

?>