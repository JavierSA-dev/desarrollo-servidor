<?php
require("../vendor/autoload.php");


use Dotenv\Dotenv;
use App\Models\Bookmark;
use App\Models\Usuarios;

session_start();

//Obtenemos las constantes con lo que tenemos en $_ENV;
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

define("DBHOST", $_ENV["DB_HOST"]);
define("DBUSER", $_ENV["DB_USER"]);
define("DBPASS", $_ENV["DB_PASSWD"]);
define("DBNAME", $_ENV["DB_NAME"]);
define("DBPORT", $_ENV["DB_PORT"]);

if (!isset($_SESSION["perfil"])) {
    $_SESSION["perfil"] = "invitado";
}

if (!isset($_SESSION["contador"])) {
    $_SESSION["contador"] = 0;
}
$ObjUsuario = Usuarios::getInstancia();
$ObjBookmark = Bookmark::getInstancia();

if (isset($_POST["inicioSesion"])) {
    $_SESSION['user'] = $ObjUsuario->getByUserPassword($_POST);
    $arrayPerfil = $ObjUsuario->getPerfil($_POST);
    $arrayBloqueado = $ObjUsuario->isbBloqued($_POST);
    foreach ($arrayPerfil as $key => $value) {
        $_SESSION["perfil"] = $value["perfil"];
    }

    if ($_SESSION["perfil"] == "invitado") {
        echo "Usuario o contraseña incorrectos";
        $_SESSION["contador"]++;
        echo $_SESSION["contador"];
    }

    if ($_SESSION["contador"] == 3) {
        print_r($_POST);
        // $ObjUsuario->bloquear($_POST);
    }

    foreach ($arrayBloqueado as $key => $value) {
        if ($value["bloqueado"] == 1) {
            $_SESSION["bloqueado"] = 1;
        } else {
            $_SESSION["bloqueado"] = 0;
        }
    }
}


if (isset($_POST["enviarBloq"])) {
    // method of php to get all the keys of a array
    $keys = array_keys($_POST["bloqueado"]);
    $ids = array();
    foreach ($keys as $key => $value) {
        $ids[] = $_POST["id"][$value];
    }
    $ObjUsuario->desbloquearByArrayIds($ids);
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
    <h1>Bookmarks</h1>
    <?php
    if ($_SESSION["perfil"] == "invitado") {
    ?>
        <form action="" method="POST">
            Usuario <input type="text" name="user">
            Contraseña <input type="password" name="psw">
            <input type="submit" name="inicioSesion" value="Iniciar Sesion"><br />
        </form>
    <?php
        // if ($_SESSION["bloqueado"] == 1) {
        //     echo "El usuario esta bloqueado";
        // }
    }
    ?>


    <?php
    if ($_SESSION["perfil"] == "admin") {
        $data = $ObjUsuario->getAll();
    ?>
        <form action="" method="post">
            <?php
            $count = 0;
            foreach ($data as $key => $value) {
                if ($value["bloqueado"] == 1) {
                    $count++;
            ?>
                    <input type="text" name="nombre[<?php echo $key; ?>]" readonly value="<?php echo $value['nombre'] ?>">
                    <input type="checkbox" name="bloqueado[<?php echo $key; ?>]" >
                    <input type="hidden" name="id[<?php echo $key; ?>]" value="<?php echo $value['id'] ?>">
            <?php
                }
            }
            if ($count == 0) {
                echo "No hay usuarios bloqueados";
            }else{
            ?>
                <input type="submit" name="enviarBloq" value="Desbloquear">
            <?php
            }
            ?>
        </form>


        <?php
    } else if ($_SESSION["perfil"] == "user") {
        $data = $ObjBookmark->getByUserId($_SESSION['user'][0]['id']);
        foreach ($data as $key => $value) {
        ?>
            <form action="" method="get">
                <input type="text" name="bm_url" readonly value="<?php echo $value['bm_url'] ?>">
                <input type="text" name="descripcion" readonly value="<?php echo $value['descripcion'] ?>">
                <?php
                echo "<a href=\"edit.php?id=$value[id]\">Editar</a>";
                echo "<a href=\"delete.php?id=$value[id]\">Borrar</a>";
                ?>
            </form>

    <?php
        }
        $idUsuario = $data[0]['idUsuario'];
        echo "<a href=\"add.php?idUsuario=$idUsuario\">Añadir</a>";
    }

    if ($_SESSION["perfil"] == "admin" || $_SESSION["perfil"] == "user") {
        echo "<br/><a href=\"../cierresesion.php\">Cerrar Sesion</a><br/>";
    }

    ?>
</body>

</html>