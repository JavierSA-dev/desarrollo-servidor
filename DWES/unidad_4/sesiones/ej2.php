<?php
session_start();
if (isset($_SESSION['nombre'])) {
    echo "<br>" . $_SESSION['nombre'];
}else {
    $_SESSION['nombre'] = "";
}
if (isset($_POST['send'])) {
    $_SESSION['nombre'] = $_POST['nombre'];
}
echo gethostbyname(gethostname()). "<br>"; ; 
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
    <form action="" method="post">
        <input type="text" name="nombre">
        <input type="submit" value="Enviar" name="send">
    </form>
</body>
</html>