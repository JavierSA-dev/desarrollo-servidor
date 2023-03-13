<?php
session_start();
if (isset($_POST['nuevaPartida'])) {
    session_unset();
    session_destroy();
}
$plantadoMes = "";


if (!isset($_SESSION['factorDeRiesgo']) || !isset($_SESSION['plantaUser']) || !isset($_SESSION['plantaPC'])) {
    $_SESSION['factorDeRiesgo'] = rand(5, 7);
    $_SESSION['plantaUser'] = false;
    $_SESSION['plantaPC'] = false;

    $_SESSION['pointsUser'] = 0;
    $_SESSION['pointsPC'] = 0;
}


if (!isset($_COOKIE['wins'])) {
    setcookie('wins', 0, time() + 3600);
}

if (!isset($_SESSION['baraja'])) {
    $_SESSION['baraja'] = array();
    for ($i = 1; $i <= 40; $i++) {
        array_push($_SESSION['baraja'], "$i");
    }
    shuffle($_SESSION['baraja']);
}

if (isset($_POST['resetCookies'])) {
    setcookie('wins', 0, time() + 3600);
    header('Location: index.php');
}
if (!isset($_SESSION['barajaUser']) && !isset($_SESSION['baraPC'])) {
    $_SESSION['barajaUser'] = array();
    $_SESSION['barajaPC'] = array('reverso');
}

// funcion que devuelve un numero aleatorio entre 1 y 40 y comprueba que no este en el array y si este en el array de la baraja
function randBaraja($array)
{
    $carta = rand(1, 40);
    if (in_array($carta, $array) || !in_array($carta, $_SESSION['baraja'])) {
        randBaraja($array);
    } else {
        return $carta;
    }
}


if (isset($_POST['pedir'])) {
    if (!$_SESSION['plantaUser']) {
        $carta = randBaraja($_SESSION['barajaUser']);
        echo $carta;
        array_push($_SESSION['barajaUser'], "$carta");
        unset($_SESSION['baraja'][$carta]);
    }

    if (!$_SESSION['plantaPC']) {
        $carta = randBaraja($_SESSION['barajaPC']);
        array_push($_SESSION['barajaPC'], "$carta");
        unset($_SESSION['baraja'][$carta]);
        if (count($_SESSION['barajaUser']) == 1) {
            array_shift($_SESSION['barajaPC']);
        }
    }

    $_SESSION['pointsPC'] = 0;

    foreach ($_SESSION['barajaPC'] as $key => $value) {
        if ($value % 10 == 8 || $value % 10 == 9 || $value % 10 == 0) {
            $_SESSION['pointsPC'] += 0.5;
        } else {
            $_SESSION['pointsPC'] += $value % 10;
        }
    }

    $_SESSION['pointsUser'] = 0;

    foreach ($_SESSION['barajaUser'] as $key => $value) {
        if ($value % 10 == 8 || $value % 10 == 9 || $value % 10 == 0) {
            $_SESSION['pointsUser'] += 0.5;
        } else {
            $_SESSION['pointsUser'] += $value % 10;
        }
    }

    if ($_SESSION['pointsUser'] > 7.5 and $_SESSION['plantaPC']) {
        $_SESSION['plantaUser'] = true;
    }

    if ($_SESSION['pointsPC'] > $_SESSION['factorDeRiesgo']) {
        $_SESSION['plantaPC'] = true;
    }
}

if (isset($_POST['plantar'])) {
    $_SESSION['plantaUser'] = true;

    while ($_SESSION['pointsPC'] < $_SESSION['factorDeRiesgo']) {
        $carta = rand(1, 40);
        array_push($_SESSION['barajaPC'], "$carta");
        unset($_SESSION['baraja'][$carta]);

        $_SESSION['pointsPC'] = 0;

        foreach ($_SESSION['barajaPC'] as $key => $value) {

            if ($value % 10 == 8 || $value % 10 == 9 || $value % 10 == 0) {
                $_SESSION['pointsPC'] += 0.5;
            } else {
                $_SESSION['pointsPC'] += $value % 10;
            }
        }
    }


    if ($_SESSION['pointsPC'] > $_SESSION['factorDeRiesgo']) {
        $_SESSION['plantaPC'] = true;
    }


}
if ($_SESSION['plantaUser'] and $_SESSION['plantaPC']) {
    // comprueba quien gana teniendo en cuenta el puntuaje de $_SESSION['pointsUser'] y $_SESSION['pointsPC'], gana el que se acerce mas al 7.5 sin pasarse
    if ($_SESSION['pointsUser'] > 7.5 and $_SESSION['pointsPC'] > 7.5) {
        $ganador = "Empate";
    } elseif ($_SESSION['pointsUser'] > 7.5) {
        $ganador = "Gana la PC";
    } elseif ($_SESSION['pointsPC'] > 7.5) {
        $ganador = "Gana el usuario";
        setcookie('wins', $_COOKIE['wins'] + 1, time() + 3600);
    } elseif ($_SESSION['pointsUser'] > $_SESSION['pointsPC']) {
        $ganador = "Gana el usuario";
        setcookie('wins', $_COOKIE['wins'] + 1, time() + 3600);
    } elseif ($_SESSION['pointsUser'] < $_SESSION['pointsPC']) {
        $ganador = "Gana la PC";
    } else {
        $ganador = "Empate";
    }
    echo $ganador;

}
if (isset($plantadoMes)) {
    if ($_SESSION['plantaPC']) {
        $plantadoMes = "El PC se ha plantado";
    }
}else{
    $plantadoMes = "";
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
    <h1>Las 7 y 1/2</h1>
    <p>Numero de victorias<?php echo $_COOKIE['wins'] ?></p>
    <form action="" method="post">
        <input type="submit" name="pedir" value="Pedir carta">
        <input type="submit" name="plantar" value="Plantar">
        <input type="submit" name="resetCookies" value="Iniciar Victorias">
        <input type="submit" name="nuevaPartida" value="Nueva Partida">
    </form>
    <h2>Jugador</h2>
    <?php
    foreach ($_SESSION['barajaUser'] as $key => $value) {
        echo "<img src='img/$value.jpg' alt=''>";
    }
    ?>
    <h2>Maquina</h2>
    <?php

    foreach ($_SESSION['barajaPC'] as $key => $value) {
        if ($_SESSION['plantaUser'] == true) {
            echo "<img src='img/$value.jpg' alt=''>";
        } else
            echo "<img src='img/reverso.jpg' alt=''>";
    }
    ?>
    <p><?php echo $plantadoMes?></p>
</body>

</html>