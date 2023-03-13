<?php
require("../vendor/autoload.php");


use Dotenv\Dotenv;
use App\Models\Equipo;

session_start();

//Obtenemos las constantes con lo que tenemos en $_ENV;
$dotenv = Dotenv::createImmutable(__DIR__. "/../");
$dotenv->load();

define("DBHOST", $_ENV["DB_HOST"]);
define("DBUSER",$_ENV["DB_USER"]) ;
define("DBPASS",$_ENV["DB_PASSWD"]) ;
define("DBNAME",$_ENV["DB_NAME"]) ;
define("DBPORT",$_ENV["DB_PORT"]) ;

if (!isset($_SESSION["usuario"])) {
    $_SESSION["usuario"] = "invitado";
    $_SESSION["perfil"] = "invitado";
}

$ObjEquipo = Equipo::getInstancia();
$data = $ObjEquipo->getAll();

if (isset($_POST["inicioSesion"])) {
    $arrayPerfil = $ObjEquipo->getPerfil($_POST);
    foreach ($arrayPerfil as $key => $value) {
        $_SESSION["perfil"] = $value["perfil"];
    }
}

if (isset($_POST["buscar"])) {
    $data = $ObjEquipo->get($_POST["equipo"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CB POKEMONS</title>
</head>
<body>
    <h1>CB_POKEMONS</h1>
    <?php
    if ($_SESSION["perfil"] == "invitado") {
        ?> 
        <form action="" method="POST">
            Usuario <input type="text" name="user">
            Contraseña <input type="password" name="password">
            <input type="submit" name="inicioSesion" value="Iniciar Sesion"><br/>
        </form>
    <?php   
    }
    ?>

<?php
    if ($_SESSION["perfil"] == "admin") {
        echo "Has iniciado sesión como admin";

    }
    ?>

    <form action="" method="POST">
        <br/><input type="text" name="equipo">
        <input type="submit" name="buscar" value="Busqueda"><br/>
    </form>
    <?php
    if ($_SESSION["perfil"] == "admin") {
        echo "<form action=\"add.php\" method=\"POST\">";
        echo "<input type=\"submit\" name=\"add\" value=\"Add\">";
        echo "</form>";
        
    }
    foreach ($data as $key => $value) {
        echo "<br/> id = $value[id]; nombre de equipo = $value[equipo]; creado el $value[created_at]; actualizado el $value[updated_at] <br/>";
        if ($_SESSION["perfil"] == "admin") {
            echo "     <a href=\"edit.php?id=$value[id]\">edit</a>     <a href=\"delete.php?id=$value[id]\">delete</a>" ;
        }
    }
        if ($_SESSION["perfil"] == "admin") {
            echo "<br/><a href=\"../cierresesion.php\">Cerrar Sesion</a><br/>";
        }
        
    ?>
</body>
</html>