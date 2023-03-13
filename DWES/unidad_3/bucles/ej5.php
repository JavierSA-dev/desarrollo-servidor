<?php

/**
 * Dado el mes y año almacenados en variables, escribir un programa que muestre el calendario mensual
 * correspondiente. Marcar el día actual en verde y los festivos en rojo.
 * @author Javier Sánchez López
 */

date_default_timezone_set("Europe/Madrid");



$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

$month = date("m");
$year = date("Y");
$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$last_day = 1;
$firstDayOfWeek = date("w", mktime(0, 0, 0, $month, 1, $year));
$today = date("d");
$weeksOfMonth = ceil(($days + $firstDayOfWeek) / 7);

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
    'comunidad' => array(
        array(
            array('dia' => 28, 'mes' => 2),
            array('dia' => date("d", easter_date($year)), 'mes' => date("m", easter_date($year)))
        ),

    ),
    'locales' => array(
        array(
            array('dia' => 24, 'mes' => 10),
        ),
    ),
);

echo "<link rel='stylesheet' type='text/css' href='css/styles2.css'>";
echo "<link rel='stylesheet' type='text/css' href='css/styles3.css'>";
echo "<table border='1' >";
echo "<tr>";
echo "<th colspan=\"7\">" . $meses[$month - 1] . "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon icon-tabler icon-tabler-calendar-event\" width=\"50\" height=\"50\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"#ffffff\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">
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

$count = 0;

for ($d = 0; $d < $weeksOfMonth; $d++) {
    echo "<tr>";
    for ($w = $last_day; $w < ($last_day + 7); $w++) {

        echo "<td>";

        if ($w <= $days and $w >= $firstDayOfWeek) {
            $isFestivoN = false;
            $isFestivoC = false;
            $isFestivoL = false;
            foreach ($festivos['nacionales'] as $key => $value) {
                if ($value['dia'] == $w - $count and $value['mes'] == $month) {
                    $isFestivoN = true;
                }
            }
            foreach ($festivos['comunidades'] as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    if ($value2['dia'] == $w - $count and $value2['mes'] == $month) {
                        $isFestivoC = true;
                    }
                }
            }
            foreach ($festivos['locales'] as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    if ($value2['dia'] == $w - $count and $value2['mes'] == $month) {
                        $isFestivoL = true;
                    }
                }
            }
            if ($w - $count == $today) {
                echo "<span class='today'>";
                echo $w - $count;
            } elseif ($w % 7 == 0) {
                echo "<span class='sunday'>";
                echo $w - $count;
                echo "</span>";
            } elseif ($isFestivoN == true) {
                echo "<span class='festivoN'>";
                echo $w - $count;
                echo "</span>";
            } elseif ($isFestivoC == true) {
                echo "<span class='festivoC'>";
                echo $w - $count;
                echo "</span>";
            } elseif ($isFestivoL == true) {
                echo "<span class='festivoL'>";
                echo $w - $count;
                echo "</span>";
            } else {
                echo $w - $count;
            }
            echo "</span>";
        } elseif ($w > $days) {
            $isFestivoN = false;
            $isFestivoC = false;
            $isFestivoL = false;
            foreach ($festivos['nacionales'] as $key => $value) {
                if ($value['dia'] == $w - $count and $value['mes'] == $month) {
                    $isFestivoN = true;
                }
            }
            foreach ($festivos['comunidades'] as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    if ($value2['dia'] == $w - $count and $value2['mes'] == $month) {
                        $isFestivoC = true;
                    }
                }
            }
            foreach ($festivos['locales'] as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    if ($value2['dia'] == $w - $count and $value2['mes'] == $month) {
                        $isFestivoL = true;
                    }
                }
            }
            if ($w - $count <= $days) {
                if ($w - $count == $today) {
                    echo "<span class='today'>";
                    echo $w - $count;
                } elseif ($w % 7 == 0) {
                    echo "<span class='sunday'>";
                    echo $w - $count;
                    echo "</span>";
                } elseif ($isFestivoN == true) {
                    echo "<span class='festivoN'>";
                    echo $w - $count;
                    echo "</span>";
                } elseif ($isFestivoC == true) {
                    echo "<span class='festivoC'>";
                    echo $w - $count;
                    echo "</span>";
                } elseif ($isFestivoL == true) {
                    echo "<span class='festivoL'>";
                    echo $w - $count;
                    echo "</span>";
                } else {
                    echo $w - $count;
                }
                echo "</span>";
            }
        } else {
            $count++;
        }

        echo "</td>";
    }

    $last_day = $w;
    echo "</tr>";
};


echo "</table>";

?>

<a href="https://github.com/JavierSA-dev/Desarrollo-Web-en-Entorno-Servidor/blob/master/unidad_3/bucles/ej5.php" target="_blank">Ir al repositorio</a>