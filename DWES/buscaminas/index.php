<?php
session_start();
include('./lib/functions.php');
if (isset($_GET['fila']) && isset($_GET['columna'])) {
    $fila = $_GET['fila'];
    $columna = $_GET['columna'];
    if (clickCasilla($fila, $columna)) {
        echo "Has ganado";
    }else{
        echo "Has perdido";
    }
    
}
else {
    if (!isset($_SESSION['tablero'])) {
        // creo tablero visible inicializado a 0 
        $message = "";
        $tableroVisible = array();
        for ($i = 0; $i < N_FILAS; $i++) {
            $tableroVisible[$i] = array();
            for ($j = 0; $j < N_COLUMNAS; $j++) {
                $tableroVisible[$i][$j] = 0;
            }
        }
        echo "<br>";
        $_SESSION['tablero'] = crearTablero(N_FILAS, N_COLUMNAS, N_MINAS);
        $_SESSION['tableroVisible'] = $tableroVisible;
        var_dump($_SESSION['tableroVisible']);
    }
    
}

mostrarTablero($_SESSION['tablero']);
echo "<br>";

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
    <form action="" method="get">
        <?php
        mostrarTableroVisible($_SESSION['tableroVisible']);
        ?>
    </form>
    <div><?php echo $message;?></div>
</body>

</html>