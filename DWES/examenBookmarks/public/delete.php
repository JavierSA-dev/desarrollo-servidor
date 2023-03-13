<?php
require("../vendor/autoload.php");

use App\Models\Bookmark;
use Dotenv\Dotenv;
session_start();
if ($_SESSION["perfil"] != "user") {
    header("Location: index.php");
} 
else {
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();

    define("DBHOST", $_ENV["DB_HOST"]);
    define("DBUSER", $_ENV["DB_USER"]);
    define("DBPASS", $_ENV["DB_PASSWD"]);
    define("DBNAME", $_ENV["DB_NAME"]);
    define("DBPORT", $_ENV["DB_PORT"]);
    $id = $_GET["id"];
    $ObjBookmark = Bookmark::getInstancia();
    $ObjBookmark->delete($id);
    header("Location: index.php");
}

?>