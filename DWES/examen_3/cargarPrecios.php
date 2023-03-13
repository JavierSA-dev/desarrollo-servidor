<?php

/**
 * @author: Javier Sánchez López
 */
include "config/config.php";
include "lib/lib.php";

$procesarFormulario = false;
if (isset($_POST["enviar"])) {
    $procesarFormulario = true;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargarprecio</title>
</head>

<body>

    <?php
    if ($procesarFormulario) {
        $total = 0;
        foreach ($_POST as $key => $value) {
            if ($key != "enviar") {
                $total += $value;
            }
        }
        $keys = array_keys($_POST);
        for ($i = 0; $i < count($keys); $i++) {
            if ($keys[$i] != "enviar") {
                echo "Has adquirido la entrada numero " . $keys[$i];
                echo "<br>";
            }
        }
        if (count($keys) == 1) {
            echo "No has seleccionadao ninguna entrada";
        } else {
            echo "El total a pagar es de $total" . "€";
        }
    } else {

    ?>


        <h1>Entradas de la zona <?php echo $aTarifas["Pokemons"][1][$_POST["zona"]]; ?></h1>

        <?php
        $aAbonados = loadPrices();
        ?>
        <form action="" method="post">

            <table border="1">
                <?php

                foreach ($aTarifas as $key => $value) {
                    if ($_POST["partido"] == $key) {
                        $min = $value[0][0];
                        $max = $value[0][1];
                        $precio = $value[2][$_POST["zona"]];
                    }
                }
                echo "Cada entrada vale: $precio" . "€";
                $cols = 10;
                for ($i = $min; $i <= $max; $i++) {
                    if ($i % $cols == 1) {
                        echo "<tr>";
                    }
                    echo "<td>";
                    if (in_array($i, $aAbonados)) {
                        echo '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff4500" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                      </svg>';
                    } else {
                        echo "<input type='checkbox' name='$i' value='$precio'>";
                        echo $i;
                    }
                    echo "</td>";
                    if ($i % $cols == 0) {
                        echo "</tr>";
                    }
                }

                ?>
            </table>
            <input type="submit" name="enviar" value="Enviar">
        </form>
    <?php
    }
    ?>
</body>

</html>