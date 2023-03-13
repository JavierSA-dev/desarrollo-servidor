<?php
include "config/config.php";

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
    <form action="cargarPrecios.php" method="post">
        <label for="partidos">Partidos</label>
        <select name="partidos" id="">
            <?php
            for ($i = 0; $i < count($aEquipos ); $i++) {
                if ($aEquipos[$i] != "Pokemons") {
                    echo "<option value='$i'>" . $aEquipos[$i]."</option>";
                }
            }
            ?>
        </select>

        <br>
        <?php
        for ($i = 0; $i < count($aZonas); $i++) {
            echo "<input type='radio' name='zona' value='" . $aZonas[$i][0] . "'>";
            echo "<label for='zona'>" . $aZonas[$i][0] . "</label>";
        }
        ?>

        <input type="submit" name="send" value="Enviar">
    </form>
</body>

</html>