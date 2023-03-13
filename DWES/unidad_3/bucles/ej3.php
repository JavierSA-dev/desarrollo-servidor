<?php

/**
 * Tablas de multiplicar del 1 al 10. Aplicar estilos en filas/columnas
 * @author Javier Sánchez López
 */

$menserror = "";
$solution = "";
$procesarForm = false;
$correctos = array();
$fallos = array();
$resultWrongs = array();
$corrects = 0;
$wrongs = 0;
$restart = false;

if (isset($_POST)) {


    foreach ($_POST as $key => $value) {

        if (empty($value)) {
            $procesarForm = true;
            $menserror = "Faltan por introducir algunos datos";
        } elseif ($value != "Enviar") {
            $procesarForm = true;
        }
    }
}
if ($procesarForm) {

    foreach ($_POST as $key => $value) {
        if ($key != 'send') {
            $row = substr($key, 6, 1);
            if (substr($key, 7, 1) == 0) {
                $row = 10;
            }
            $col = substr($key, -1);
            if ($col == 0) {
                $col = 10;
            }
            if ($value == $row * $col) {
                $corrects++;
                array_push($correctos, array('fila' => $row, 'columna' => $col));
            } else {
                array_push($resultWrongs, $value);
                $wrongs++;
                array_push($fallos, array('fila' => $row, 'columna' => $col));
            }
        }
    }

    $porcentaje = ($corrects / ($corrects + $wrongs)) * 100;

    if ($corrects == 10) {
        $solution = "Has acertado todas, ¡enhorabuena!";
        $restart = true;
    } else {
        $solution = "Has acertado <span id='numberCorrects'>$corrects</span> y has fallado <span id='numberWrongs'>$wrongs</span>, has acertado el $porcentaje% de las preguntas";
    }
} else {
    $aAleatorios = array();
    for ($i = 0; $i < 10; $i++) {
        do {
            $randomRow = rand(1, 10);
            $randomCol = rand(1, 10);
        } while (in_array(array('row' => $randomRow, 'col' => $randomCol), $aAleatorios));

        $aAleatorios[$i]['row'] = $randomRow;
        $aAleatorios[$i]['col'] = $randomCol;
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='css/styles.css'>
    <title>Tabla multiplicar</title>
</head>

<body>
    <form action="" method="post">
        <table>
            <tr>
                <td id='header'> </td>
                <?php
                for ($f = 1; $f <= 10; $f++) {
                    echo "<td id='header'> $f </td>";
                };
                ?>
            </tr>
            <?php

            $countFallos = 0;

            for ($i = 1; $i <= 10; $i++) {
                echo "<tr>";
                echo "<td id='lateral'> $i  </td>";
                for ($j = 1; $j <= 10; $j++) {
                    if (in_array(array('row' => $i, 'col' => $j), $aAleatorios)) {
                        echo "<td class='question'><input type='number' name='numero{$i}{$j}'></td>";
                    } elseif (in_array(array('fila' => $i, 'columna' => $j), $correctos)) {
                        $result = $i * $j;
                        echo "<td class='correct question'>";
                        echo "<input type='number' value={$result} name='numero{$i}{$j}'>";
                        echo "</td>";
                    } elseif (in_array(array('fila' => $i, 'columna' => $j), $fallos)) {
                        if ($resultWrongs[$countFallos] == "") {
                            echo "<td class='question wrong'><input type='number' name='numero{$i}{$j}'></td>";
                        } else {
                            echo "<td class='question wrong'><input value={$resultWrongs[$countFallos]} type='number' name='numero{$i}{$j}'></td>";
                        }
                        $countFallos++;
                    } else {
                        echo "<td>";
                        echo $i * $j;
                        echo "</td>";
                    }
                };
                echo "</tr>";
            };
            ?>

        </table>
        <input type="submit" name="send" value="Enviar"></input>
        <div class="finished">
            <div id="meserror"><?php echo $menserror ?></div>
            <hr>
            <div id="solutionmesg">
                <?php echo $solution ?>
            </div>
        </div>
        <?php
            if ($restart) {
        ?>
            <a id="linkRestart" href="ej3.php">Reiniciar</a>
            
        <?php
        }
        ?>
    </form>


</body>

<a class="githubLink" href="https://github.com/JavierSA-dev/Desarrollo-Web-en-Entorno-Servidor/blob/master/unidad_3/bucles/ej3.php" target="_blank">
    <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" width="60px" alt="logoGithub" srcset="">
</a>
</html>
