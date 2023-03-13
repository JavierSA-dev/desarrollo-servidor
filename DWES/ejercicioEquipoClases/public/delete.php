<?php
require("../vendor/autoload.php");

use App\Models\Equipo;
use Dotenv\Dotenv;
session_start();
if(!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != "admin"){
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
    $ObjEquipo = Equipo::getInstancia();
    $ObjEquipo->delete($id);
    header("Location: index.php");
}

?>