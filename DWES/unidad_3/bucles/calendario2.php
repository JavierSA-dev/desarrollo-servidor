<?php

/**
 * Dado el mes y año almacenados en variables, escribir un programa que muestre el calendario mensual
 * correspondiente. Marcar el día actual en verde y los festivos en rojo.
 * @author Javier Sánchez López
 */
$mensajError = "";
if (isset($_POST['enviar'])) {
    if (empty($_POST['fecha'])) {
        $mensajError = "¡No se han introducido una fecha!";
        $month = date('n');
        $year = date('Y');
    }else{
        $year = substr($_POST['fecha'], 0, 4);
        $month = substr($_POST['fecha'], 5, 2);
    }
}else{
    $month = date('n');
    $year = date('Y');
}

function getHolyThursday($year)
{
    $easterDate = easter_date($year);
    $easterDay = date('j', $easterDate);
    $easterMonth = date('n', $easterDate);
    $easterYear = date('Y', $easterDate);
    $holyThursday = mktime(0, 0, 0, $easterMonth, $easterDay - 3, $easterYear);
    $holyThursday = date('j', $holyThursday);
    return $holyThursday;
}
date_default_timezone_set("Europe/Madrid");
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");


$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$firstDayOfWeek = date("w", mktime(0, 0, 0, $month, 1, $year));
$today = date("d");

$festivos = array(
    'nacionales' => array(
        array('dia' => 1, 'mes' => 1),
        array('dia' => 6, 'mes' => 1),
        array('dia' => 19, 'mes' => 3),
        array('dia' => 1, 'mes' => 5),
        array('dia' => 15, 'mes' => 8),
        array('dia' => 12, 'mes' => 10),
        array('dia' => 1, 'mes' => 11),
        array('dia' => 6, 'mes' => 12),
        array('dia' => 8, 'mes' => 12),
        array('dia' => 25, 'mes' => 12)
    ),
    'comunidades' => array(
        array('dia' => 28, 'mes' => 2),
        array('dia' => getHolyThursday($year), 'mes' => 4),
        array('dia' => getHolyThursday($year) + 1, 'mes' => 4)
    ),
    'locales' => array(
        array('dia' => 24, 'mes' => 10),
    ),
);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='css/styles2.css'>
    <link rel='stylesheet' type='text/css' href='css/styles3.css'>
    <link rel="icon" href="css/messi.jpg">
    <title>Calendario 😎</title>
</head>

<body>
        <div id="msgerror"><?php echo $mensajError; ?></div>
    <?php

    echo "<table border='1' >";
    echo "<tr>";
    echo "<th colspan=\"7\">" . $meses[$month - 1] . "-" . $year . " " . "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon icon-tabler icon-tabler-calendar-event\" width=\"50\" height=\"50\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"#ffffff\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
    <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/>
    <rect x=\"4\" y=\"5\" width=\"16\" height=\"16\" rx=\"2\" />
    <line x1=\"16\" y1=\"3\" x2=\"16\" y2=\"7\" />
    <line x1=\"8\" y1=\"3\" x2=\"8\" y2=\"7\" />
    <line x1=\"4\" y1=\"11\" x2=\"20\" y2=\"11\" />
    <rect x=\"8\" y=\"15\" width=\"2\" height=\"2\" />
    </svg></th>";


    echo "</tr>";
    echo "<tr>";
    echo "<th>L</th>";
    echo "<th>M</th>";
    echo "<th>X</th>";
    echo "<th>J</th>";
    echo "<th>V</th>";
    echo "<th>S</th>";
    echo "<th>D</th>";
    echo "</tr>";
    echo "<tr>";
    // imprime las primeras celdas vacias
    for ($b = 1; $b < $firstDayOfWeek; $b++) {
        echo "<td></td>";
    };

    for ($d = 1; $d <= $days; $d++) {
        switch ($d) {
            case $today:
                echo "<td class='today'>$d</td>";
                break;
            case $b % 7 == 0:
                echo "<td class='sunday'>$d</td>";
                break;
            default:
                foreach ($festivos['nacionales'] as $key => $value) {
                    if ($value['dia'] == $d && $value['mes'] == $month) {
                        echo "<td class='festivoN'>$d</td>";
                        break 2;
                    }
                }
                foreach ($festivos['comunidades'] as $key2 => $value2) {
                    // Imprime el dia y mes
                    if ($value2['dia'] == $d && $value2['mes'] == $month) {
                        echo "<td class='festivoC'>$d</td>";
                        break 2;
                    }
                }
                foreach ($festivos['locales'] as $key3 => $value3) {
                    if ($value3['dia'] == $d && $value3['mes'] == $month) {
                        echo "<td class='festivoL'>$d</td>";
                        break 2;
                    }
                }
                echo "<td>$d</td>";
                break;
        }

        // si es domingo, se cierra la fila
        if ($b % 7 == 0) {
            echo "</tr>";
            echo "<tr>";
        }

        // imprime las ultimas celdas vacias
        if ($d == $days) {
            for ($b; $b % 7 != 0; $b++) {
                echo "<td></td>";
            }
        }
        $b++;
    }

    echo "</table>";
    ?>
    <form action="" method="post">
        <div class="calendar">
            <label for="calendario">Introduce una fecha</label>
            <input type="month" name="fecha" name="enviar">
            <input type="submit" name="enviar" value="Enviar">
        </div>
    </form>
    <a href="https://github.com/JavierSA-dev/Desarrollo-Web-en-Entorno-Servidor/blob/master/unidad_3/bucles/calendario2.php" target="_blank">
        <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" width="60px" alt="logoGithub" srcset="">
    </a>
</body>

</html>