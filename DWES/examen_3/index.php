<?php
include "config/config.php";
/**
 * @author: Javier Sánchez López
 */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Javier Sánchez López</title>
</head>

<body>
    <h1>Club Baloncesto Pokemon</h1>

    <form action="cargarPrecios.php" method="post">
        <label for="partidos">Partidos</label>
        <select name="partido" id="">
            <?php

            foreach ($aTarifas as $key => $value) {
                if ($key != "Pokemons") {
                    echo "<option value='$key'>$key</option>";
                }
            }


            ?>
        </select>
        <br>
        <?php
        for ($i = 0; $i < count($aTarifas["Pokemons"][1]); $i++) {
            echo "<input type='radio' required name='zona' value='" . $i . "'>";
            echo "<label for='zona'>" . $aTarifas["Pokemons"][1][$i] . "</label>";
        }


        ?>
        <input type="submit" value="Enviar" name="send">
    </form>
</body>

</html>