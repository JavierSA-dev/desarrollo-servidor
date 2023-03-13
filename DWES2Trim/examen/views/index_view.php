<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <h1>Gestion de multas</h1>
    <?php
    $videos = ["https://www.youtube.com/embed/GRR8QT2Bpz4", "https://www.youtube.com/embed/VPCsb9U5970", "https://www.youtube.com/embed/_CJ_7dFShQE"];

    shuffle($videos);
    if ($_SESSION['auth'] == "guest") {
        include_once 'login_view.php';
    }

    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }


    ?>


    <?php
    if ($_SESSION['auth'] !== 'guest') {
        echo "<p>Usted esta logueado como: " .  $_SESSION['user'][0]['usuario'] . "</p>";
        echo "<a href='http://examen.localhost/logout'>Cerrar Sesión</a>";
        echo "<br>";
        echo "<a href='http://examen.localhost/'>Inicio</a>";
        if ($_SESSION['auth'] == 'admin') {
            echo "<a href='http://examen.localhost/admin'>Administrar</a>";
        }
        if ($_SESSION['auth'] == 'agente' || $_SESSION['auth'] == 'conductor') {
            echo "<a href='http://examen.localhost/listmultas'>Listar Multas</a>";
        }
        if ($_SESSION['auth'] == 'agente') {
            echo "<a href='http://examen.localhost/addMulta'>Añadir multa</a>";
        }
    }
    echo "<br>";
    echo "<iframe width='560' height='315' src='" . $videos[0] . "?autoplay=1' title='YouTube video player' frameborder='0' allow='autoplay'  clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";








    ?>

    </table>

</body>

</html>