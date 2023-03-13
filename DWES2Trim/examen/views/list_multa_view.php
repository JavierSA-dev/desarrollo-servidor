<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    ?>
    <table>
        <h1>Gestión de multas</h1>
        <p>Usted esta logueado como: <?php echo  $_SESSION['user'][0]['usuario']?></p>

        <a href='http://examen.localhost/logout'>Cerrar Sesión</a><br>
        <a href='http://examen.localhost/'>Inicio</a>
        <a href='http://examen.localhost/listmultas'>Listar Multas</a>
        
    <?php
        if ($_SESSION['auth'] == 'agente') {
            echo "<a href='http://examen.localhost/addMulta'>Añadir multa</a>";
        }
    ?>
        <tr>
            <th>Matricula</th>
            <th>Descripcion</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
        <?php
        if ($_SESSION['auth'] == 'agente') {
            echo "<p>Agente: " . $_SESSION['user'][0]['usuario'] . "</p>";
            echo "<p>Coeficiente: " . $_SESSION['coeficiente'] . "%</p>";
        }
        echo "<h2>Listado de multas</h2>";
        foreach ($data['multas'] as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['matricula'] . "</td>";
            echo "<td>" . $value['descripcion'] . "</td>";
            echo "<td>" . $value['fecha'] . "</td>";
            echo "<td>" . $value['estado'] . "</td>";
            if ($value['estado'] == 'Pendiente' && $_SESSION['auth'] == 'conductor') {
                echo "<td><a href='http://examen.localhost/pagar/" . $value['id'] . "'>Pagar</a></td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>