<?php

include('config/config.php');
include('include/functions.php');

// Cargamos valores 
// $valoresActuales[3][5] = 1;
$valoresActuales = array();

// Generamos valores aleatorios
/* $numerosAleatorios = array(
    array('f' => 1, 'c' => 1),
);
*/
$numerosAleatorios = array();

$procesaFormulario = false;
$numAciertos = 0;
$iconoRespuesta = '';
$claseRespuesta = '';

if (isset($_POST['send'])) {
    $procesaFormulario = true;
    foreach ($_POST['num'] as $f => $v1) {
        foreach ($v1 as $c => $v2) {
            $numerosAleatorios[] = array('f' => $f, 'c' => $c);
            $valoresActuales[$f][$c] = $v2;
            if ($valoresActuales[$f][$c] == $f * $c) {
                $numAciertos++;
            }
        }
    }
} else {
    // Generamos valores aleatorios
    for ($i = 0; $i < NUMINPUTS; $i++) {
        do {
            $fila = rand(1, NUMTABLAS);
            $columna = rand(1, NUMTABLAS);
        } while (existeCoordenada($fila, $columna, $numerosAleatorios));
        $numerosAleatorios[] = array('f' => $fila, 'c' => $columna);
        $valoresActuales[$fila][$columna] = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Tabla Mejorada</title>
</head>

<body>
    <h1>Completa la tabla de multiplicar</h1>
    <form action="" method="post">
        <table>
            <tr>
                <td class="cabecera">X</td>
                <?php
                for ($i=0; $i<=  NUMTABLAS; $i++) { 
                    echo "<td class='cabecera'>$i</td>";
                }
                for ($f = 1; $f <= NUMTABLAS; $f++) {
                    echo "<tr>";
                    echo "<td class='cabecera'>$f</td>";
                    for ($c = 0; $c <= NUMTABLAS; $c++) {
                        if (existeCoordenada($f, $c, $numerosAleatorios)) {
                            if ($procesaFormulario) {
                                $iconoRespuesta = $valoresActuales[$f][$c] == $f * $c ? '✅' : '❌';
                                $claseRespuesta = $valoresActuales[$f][$c] == $f * $c ? 'acierto' : 'fallo';
                            }
                            echo "<td><input type='text' title='$f.'X'.$c' name=num[" . $f . "][" . $c . "] value='{$valoresActuales[$f][$c]}' class='$claseRespuesta' >$iconoRespuesta</td>";
                        } else {
                            echo "<td>" . $f * $c . "</td>";
                        }
                    }
                    echo "</tr>";
                }
                ?>
        </table>
        <input type="submit" name="send" value="Send">
    </form>
    <?php
    // Mostramos resultados
    if ($procesaFormulario) {
        echo "<p>Has acertado $numAciertos de " . NUMINPUTS . " números</p>";
        if ($numAciertos == NUMINPUTS) {
            echo "<p>¡Enhorabuena!</p>";
            echo "<p><a href='index.php'>Volver a jugar</a></p>";
        }
    }
    ?>
</body>

</html>