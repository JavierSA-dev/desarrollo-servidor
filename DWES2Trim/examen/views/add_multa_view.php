<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir multa</title>
</head>

<body>
    <h1>Gestión de multas</h1>

    <p>Usted esta logueado como: <?php echo $_SESSION['user'][0]['usuario'] ?></p>
    <a href='http://examen.localhost/logout'>Cerrar Sesión</a><br>
    <a href='http://examen.localhost/'>Inicio</a>
    <a href='http://examen.localhost/listmultas'>Listar Multas</a>
    <a href='http://examen.localhost/addMulta'>Añadir multa</a>
    <?php

    echo "<p>Agente: " . $_SESSION['user'][0]['usuario'] . "</p>";
    echo "<p>Coeficiente: " . $_SESSION['coeficiente'] . "%</p>";

    ?>
    <h2>Nueva multa</h2>
    <!--  -->
    <form action="" method="post">
        <label for="matricula">Matricula:</label>
        <input type="text" name="matricula" id="matricula"><br>
        <label for="fecha"></label>
        <input type="date" name="fecha" id=""><br>
        <select name="id_conductor">
            <?php

            foreach ($data['conductores'] as $key => $value) {
                echo "<option value= '$value[id]'>$value[nombre]</option>";
            }

            ?>

        </select>
        <br>
        <input type="radio" id="Leve" name="id_tipo_sanciones" value="1">
        <label for="Leve">Leve</label>
        <input type="radio" id="Grave" name="id_tipo_sanciones" value="2">
        <label for="Grave">Grave</label>
        <input type="radio" id="MuyGrave" name="id_tipo_sanciones" value="3">
        <label for="MuyGrave">Muy Grave</label><br>
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id=""><br>
        <input type="hidden" name="id_agente" value="<?php echo $_SESSION['user'][0]['id'] ?>">
        <input type="submit" value="Añadir" name="add">
    </form>
</body>

</html>