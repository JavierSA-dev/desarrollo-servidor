<?php
session_start();
include "config/config.php";
include "lib/lib.php";
$procesarFormulario = false;
$showTable = false;
$procesarCompra = false;
$error = "";

if (isset($_POST['seguir'])) {
    $procesarCompra = false;
    $showTable = false;
    $procesarFormulario = true;
}

if($_SESSION['user'] and isset($_SESSION['pass'])){
    echo "sesion iniciada";
    print_r($_SESSION);
    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];
    if (empty($user) || empty($pass)) {
        $procesarFormulario = false;
        $error = "Debe rellenar todos los campos";
    } elseif ($user = !"usuario" || $pass != "usuario") {
        $procesarFormulario = false;
        $error = "Usuario o contraseña incorrectos";
    } else {
        $procesarFormulario = true;
        session_start();
    }
}else{
    if (isset($_POST['send'])) {
        echo "formulario enviado";
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['pass'] = $_POST['pass'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
    
        if (empty($user) || empty($pass)) {
            $procesarFormulario = false;
            $error = "Debe rellenar todos los campos";
        } elseif ($user = !"usuario" || $pass != "usuario") {
            $procesarFormulario = false;
            $error = "Usuario o contraseña incorrectos";
        } else {
            $procesarFormulario = true;
            session_start();
        }
    }
}



if (isset($_POST['partidoszonas'])) {
    $procesarFormulario = true;
    $_SESSION['equipo'] = $_POST['equipo'];
    $_SESSION['zona'] = $_POST['zona'];
    $showTable = true;
}

if (isset($_POST['compra'])) {
    $procesarCompra = true;
    $zona = $_POST['zona'];
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
    <h1>Club Baloncesto Pokemon</h1>
    <a href="index.php">Inicio</a>
    <?php
    if ($procesarCompra) {
    ?>
        <h2>Compra realizada con éxito</h2>
        
        <?php
        $nuevaInformacion = array();
        $entradas = array();
        $total = 0;
        foreach ($_POST as $key => $value) {
            if ($key != "equipo" && $key != "zona" && $key != "compra") {
                $total += $value;
                $entradas[] = array($key => $value);
            }
        }
        // TODO si en el array nuevaInformacion ya existe el equipo y la zona, añadir las entradas en vez de crear un nuevo array

        if (in_array($_POST['equipo'], $nuevaInformacion) and in_array($_POST['zona'], $nuevaInformacion)) {
            echo "existe";
            $nuevaInformacion[] = $entradas;
            $nuevaInformacion[] = $total;
        } else {
            echo "no existe";
            $nuevaInformacion['equipo'] = $_POST['equipo'];
            $nuevaInformacion['zona'] = $_POST['zona'];
            $nuevaInformacion['entradas'] = $entradas;
            $nuevaInformacion['total'] = $total;
        }
        print_r($nuevaInformacion);
        echo "<br>";
        print_r($_POST);
        $_SESSION['carrito'][] = $nuevaInformacion;
        foreach ($_SESSION['carrito'] as $key => $value) {
            echo "<h3>Compra del equipos ".$value["equipo"]."</h3>";
            echo "<h3>Zona: ".$value["zona"]."</h3>";
            echo "<h4>Entradas: </h4>";
            foreach ($value["entradas"] as $key => $value2) {
                foreach ($value2 as $key => $value3) {
                    echo "<p>Nº ".$key." = ".$value3."€</p>";
                }
            }
            echo "<br>";
        }

        foreach ($_SESSION['carrito'] as $key => $value) {
            $totalCarrito += $value["total"];
        }

        ?>
        <p>Total: <?php echo $totalCarrito ?>€</p>
        <form action="" method="POST">
            <input type="submit" name="seguir" value="Seguir comprando">
        </form>
    <?php

    } else {
    ?>
        <?php
        if ($procesarFormulario) {
        ?>
            <h2>Selecciona el Equipo y zona</h2>
            <form action="" method="post">
                <label for="equipos">Equipos</label>
                <select name="equipo" id="">
                    <?php

                    for ($i = 0; $i < count($equipos); $i++) {
                        if ($_SESSION['equipo'] == $equipos[$i]) {
                            echo "<option selected value='$equipos[$i]'>$equipos[$i]</option>";
                        } else {
                            echo "<option value='$equipos[$i]'>$equipos[$i]</option>";
                        }
                    }

                    ?>
                </select>
                <br>
                <?php

                for ($i = 0; $i < count($zonas); $i++) {
                    echo '<label for="zona">' . $zonas[$i]["zona"] . '</label>';
                    if ($_SESSION['zona'] == $i) {
                        echo "<input type='radio' required name='zona' value='" . $i . "' checked>";
                    } else {
                        echo '<input type="radio" required name="zona" value=' . $i . '>';
                    }
                }

                ?>
                <input type="submit" value="Enviar" name="partidoszonas">
            </form>
            <?php

            $abonados = generarAbonos();

            if ($showTable) {
                foreach ($tarifas as $key => $value) {
                    if ($value['equipo'] == $_SESSION['equipo']) {
                        $zonaSession = $value['tarifas'][$_SESSION['zona']]['zona'];
                        $precioSession = $value['tarifas'][$_SESSION['zona']]['precio'];
                        echo "<h2>Entradas de la zona " . $zonaSession . "</h2>";
                    }
                }

                foreach ($zonas as $key => $value) {
                    if ($zonaSession == $value['zona']) {
                        $primera_localidad = $value['primera_localidad'];
                        $ultima_localidad = $value['ultima_localidad'];
                    }
                }
            ?>
                <form action="" method="POST">

                    <?php
                    echo "Cada entrada vale: " . $precioSession . "€";
                    echo "<br>";
                    echo "<br>";
                    for ($i = $primera_localidad; $i <= $ultima_localidad; $i++) {
                        if (in_array($i, $abonados)) {
                            if ($i % NCOLUMNAS == 0) {
                                echo "<span style='color:red'>" . $i . "<input type='checkbox' name='$i' value='$precioSession' disabled></span> ";
                                echo "<br>";
                            } else {
                                echo "<span style='color:red'>" . $i . "<input type='checkbox' name='$i' value='$precioSession' disabled></span> ";
                            }
                        } else {
                            if ($i % NCOLUMNAS == 0) {
                                echo $i . " <input type='checkbox' name='$i' value='$precioSession' >";
                                echo "<br>";
                            } else {
                                echo $i . " <input type='checkbox' name='$i' value='$precioSession' >";
                            }
                        }
                    }



                    ?>
                    <input type="hidden" name="zona" value=<?php echo $zonaSession ?>>
                    <input type="hidden" name="equipo" value=<?php echo $_SESSION['equipo'] ?>>
                    <input type="submit" name="compra" value="compra">
                </form>
            <?php
            }
            ?>
            </form>

        <?php

        } else {
        ?>
            <form action="" method="POST">
                <label for="user">Usuario</label>
                <input type="text" name="user" id="user" value="usuario"><br><br>
                <label for="pass">Contraseña</label>
                <input type="password" name="pass" id="pass" value="usuario"><br><br>
                <input type="submit" name="send">
            </form>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/FMcbaFBRK6Y?autoplay=1&mute=1" frameborder="0" allowfullscreen></iframe><br>
        <?php
        }

        ?>
    <?php
    }
    ?>
    <div><?php echo $error; ?></div>

</body>

</html>