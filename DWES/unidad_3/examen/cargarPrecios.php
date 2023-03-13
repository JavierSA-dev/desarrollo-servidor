<?php

include "config/config.php";
include "lib/lib.php";

// print_r($_POST);
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
        print_r($_POST);
        echo "Has adquirido la entrada " . array_keys($_POST)[1] . " por un precio de " . $_POST[array_keys($_POST)[1]] ."€";
        
        
    } else {
    
    ?>

    <h1>Entradas de la zona <?php echo $_POST["zona"] ?></h1>
    <form action="" method="post">

        <table border="1">
            <?php
            $aLocalidades = loadPrices();

            for ($i = 0; $i < count($aZonas); $i++) {
                if ($aZonas[$i][0] == $_POST["zona"]) {
                    $range = $aZonas[$i][1];
                }
            }
            $cols = 10;
            $rows = 40;
            $count = 0;
            for ($i = $range[0]; $i <= $range[1]; $i++) {
                if ($i % $cols == 0) {
                    $last = $i + $cols;
                    echo "<tr>";
                }

                echo "<td>";
                if (in_array($i, $aLocalidades)) {
                    echo "Ocupado";
                } else {
                    echo "<label><input type='checkbox' name=".$i." value=".$aTarifas[$_POST["zona"]]." > " . $aTarifas[$_POST["zona"]]."</label><br>";
                }
                echo "</td>";
                if ($i % $cols != 0 and $i == $last) {
                    echo "</tr>";
                }
            }

            ?>
        <input type="submit" name="enviar" value="Enviar">
        </table>
    </form>
    <?php
    }
    ?>
</body>

</html>