<?php

include_once 'config/config.php';
$procesarForm = false;
$showSend2 = false;
$mesError = "";
$mesResultados = "";
$numVerbos = "";
if (isset($_POST['send']) or isset($_POST['enviar'])) {
    if (isset($_POST['enviar'])) {
        $mesResultados = "hola";
    }else{
        if ($_POST['numVerbos'] > count($irregularVerbs) - 1 or $_POST['numVerbos'] < 1) {
            $mesError = "El número de verbos no puede ser menor que 1 o mayor que " . (count($irregularVerbs) - 1);
        } else {
            $showSend2 = true;
            $procesarForm = true;
            $numVerbos = $_POST['numVerbos'];
            $dificultad = $_POST['dificultad'];
            $keys = array();
            $keys = array_rand($irregularVerbs, $numVerbos);
            switch ($dificultad) {
                case 'facil':
                    $pregunta = 1;
                    break;
                case 'medio':
                    $pregunta = 2;
                    break;
                case 'dificil':
                    $pregunta = 3;
                    break;
            }
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
    <title>Verbos irregulares</title>
</head>

<body>
    <h1>Verbos irregulares</h1>

    <form action="" method="POST">
        <label for="dificultad">Dificultad</label>
        <select name="dificultad" id="">
            <option value="facil">Fácil</option>
            <option value="medio">Medio</option>
            <option value="dificil">Difícil</option>
        </select><br><br>
        <label for="numVerbos">Número de verbos (máximo: <?php echo count($irregularVerbs) - 1 ?>)</label>
        <input type="number" name="numVerbos" id="" value=<?php echo $numVerbos; ?>>
        <input type="submit" name="send">
        <div id="erroMsg"><?php echo $mesError; ?></div>

        <?php
        if ($procesarForm) {
        ?>
            <table>
                <tr>
                    <th>Infinitivo</th>
                    <th>Pasado</th>
                    <th>Participio</th>
                    <th>Traducción</th>
                </tr>
            <?php
            foreach ($keys as $key) {
                $columnsInputs = array();
                for ($i = 1; $i <= $pregunta; $i++) {
                    $num = rand(0, 3);
                    if (in_array($num, $columnsInputs)) {
                        $i--;
                    } else {
                        $columnsInputs[] = $num;
                    }
                }
                echo "<tr>";
                for ($i = 0; $i < 4; $i++) {
                    if (in_array($i, $columnsInputs)) {
                        echo "<td><input type='text' name=" . $irregularVerbs[$key][$i] . "></td>";
                    } else {
                        echo "<td>" . $irregularVerbs[$key][$i] . "</td>";
                    }
                }
                echo "</tr>";
            }
        }
            ?>
            </table>
            <?php
            if ($showSend2) {
            ?>
                <input type="submit" name="enviar" value="Comprobar verbos">
                <?php
            }
            ?>
            <div id="resultados"><?php echo $mesResultados ?></div>
    </form>



</body>

</html>