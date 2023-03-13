<?php
include 'config/config.php';

session_start();
if (!isset($_SESSION["perfil"])) {
    $_SESSION["perfil"] = "guest";
    $_SESSION["usuarios"] = array();
}

if (isset($_POST["send"])) {
    if ($_POST['user'] != "" && $_POST['pass'] != "") {
        if ($_POST['user'] == "admin" and $_POST['pass'] == "admin") {
            $_SESSION["perfil"] = "admin";
        } else if ($_POST['user'] == "user" and $_POST['pass'] == "user") {
            $_SESSION["perfil"] = "user";
        } else {
            echo "Los datos no son correctos";
        }        
    }else{
        echo "El usuario o la contraseña no pueden estar vacios";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div id="cabecera">
        <h1>Ejercicio Autentificación</h1>
    </div>
    <div class="infcuenta">
        <?php
        if ($_SESSION["perfil"] == "guest") {
            include('include/login_form.html');
            echo "<p><a href='register.php'>Regístrate</a></p>";
        } else {
            echo "Bienvenido " . $_SESSION["perfil"];
            echo "<p><a href='exit.php'>Salir</a></p>";
        }
        ?>
    </div>
    <div class="menu">
        <?php
        if ($_SESSION["perfil"] != "guest") {
            echo "<ul>";
            foreach ($aPerfiles[$_SESSION["perfil"]] as $pagina) {
                echo "<li><a href='$pagina'>$pagina</a></li>";
            }
            echo "</ul>";
        }
        ?>
    </div>
    <div></div>
</body>

</html>