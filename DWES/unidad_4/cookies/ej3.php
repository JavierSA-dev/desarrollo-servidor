<?php

$procesar = false;
$user = "";
$pass = "";
if (isset($_COOKIE['user'])) {
    $user = $_COOKIE['user'];
    $pass = $_COOKIE['pass'];
}

if (isset($_POST['send'])) {
    if ($_POST['usuario'] == "usuario1" and $_POST['passwd'] == "1234") {
        $procesar = true;
        if (isset($_POST['save'])) {
            setcookie('user', $_POST['usuario'], time() + 3600);
            setcookie('pass', $_POST['passwd'], time() + 3600);
        }else{
            setcookie('user', $_POST['usuario'],);
            setcookie('pass', $_POST['passwd'], );
        }

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

    <?php
    if ($procesar) {
        echo "Hola " . $user . " has accedido correctamente 👍";
    } else {

    ?>

        <form action="" method="post">
            <label for="user">Usuario</label>
            <input type="text" name="usuario" id="user" value=<?php echo $user ?>>
            <label for="pass">Contraseña</label>
            <input type="password" name="passwd" id="pass" value=<?php echo $pass ?>>
            <label for="save">Recordar contraseña</label>
            <input type="checkbox" name="save">
            <input type="submit" name="send" value="Enviar">
        </form>
    <?php
    }
    ?>
</body>

</html>