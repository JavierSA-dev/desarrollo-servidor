<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar</title>
</head>
<body>
    
    <h1>Gestión de multas</h1>
        <p>Usted esta logueado como: <?php echo  $_SESSION['user'][0]['usuario']?></p>

        <a href='http://examen.localhost/logout'>Cerrar Sesión</a><br>
        <a href='http://examen.localhost/'>Inicio</a>
        <a href='http://examen.localhost/listmultas'>Listar Multas</a>
    <h2>Pago de multa</h2>

    <?php
    
    foreach ($data['multa'] as $key => $value) {}
    if ($value['estado'] === 'Pagada') {
        $_SESSION['error'] = "La multa ya ha sido pagada";
        header('Location: http://examen.localhost/listmultas');
    }
    $fecha = new DateTime($value['fecha']);
    $fecha->add(new DateInterval('P30D'));
    $fecha->format('Y-m-d');
    $hoy = new DateTime();
    $hoy->format('Y-m-d');
    if ($hoy < $fecha) {
        $value['descuento'] = 50;
    }

    $precioConDescuento = $value['importe'] - ($value['importe'] * $value['descuento'] / 100);

    
    ?>
    <form action="" method="post">
        <label for="Idmulta">Idmulta</label>
        <input type="text" name="idmulta" id="idmulta" value="<?php echo $value['id']; ?>" readonly><br>
        <label for="matricula">Matricula</label>
        <input type="text" name="matricula" id="matricula" value="<?php echo $value['matricula']; ?>" readonly><br>
        <label for="conductor">Conductor</label>
        <input type="text" name="conductor" id="conductor" value="<?php echo $data['conductor'][0]['nombre']; ?>" readonly><br>
        <label for="tipo">Tipo de infraccion</label>
        <input type="text" name="tipo" id="tipo" value="<?php echo $data['tipo_sancion'][0]['tipo']; ?>" readonly><br>
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" value="<?php echo $value['descripcion']; ?>" readonly><br>
        <label for="fecha">Fecha</label>
        <input type="text" name="fecha" id="fecha" value="<?php echo $value['fecha']; ?>" readonly><br>
        <label for="importe">Importe</label>
        <input type="text" name="importe" id="importe" value="<?php echo $precioConDescuento; ?>" readonly><br>
        <label for="bonificacion">Bonificacion</label>
        <input type="text" name="bonificacion" id="bonificacion" value="<?php echo $value['descuento']; ?>" readonly><br>
        <input type="submit" value="Enviar" name="pagar">
    </form>
</body>
</html>