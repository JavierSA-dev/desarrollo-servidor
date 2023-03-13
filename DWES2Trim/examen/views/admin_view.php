<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .rojo{
            color: red;
        }
    </style>
</head>

<body>
    <h1>Gestion de multas</h1>
    <p>Usted esta logueado como: <?php echo  $_SESSION['user'][0]['usuario'] ?></p>
    <a href='http://examen.localhost/logout'>Cerrar Sesión</a><br>
    <a href='http://examen.localhost/'>Inicio</a>
    <a href='http://examen.localhost/admin'>Administrar</a>
    <h2>Gestion de conductores</h2>
    <form action="" method="post">
        <label for="search">Buscar</label>
        <input type="text" name="nombre" id="nombre" placeholder="Introduce nombre">
        <input type="submit" name="searcher" value="Buscar">
    </form>

    <form action='' method='post'>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Puntos</th>
                <th>Sanciones</th>
            </tr>
            <?php
            foreach ($data['conductores'] as $key => $value) {
                if ($value['puntos'] > 10) {
                    echo "<tr class = 'rojo';'>";
                } else {
                    echo "<tr>";
                }
                echo "<td>" . $value['nombre'] . "</td>";
                echo "<td>" . $value['puntos'] . "</td>";
                echo "<td>" . $value['sanciones'] . "</td>";
                if ($value['puntos'] > 10) {
                    echo "<td><input type='checkbox' name='id[]' value='$value[id]'></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            ?>
            <input type="submit" value="Reniciar puntos" name="restart">
    </form>
</body>

</html>