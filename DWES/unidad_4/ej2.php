<?php

/**
 * Gestión de formulario
 * @author Javier Sánchez López
 * 
 */

$num1 = 0;
$num2 = 0;
$mensajError = "";
$procesarForm = false;

print_r($_POST['send']);

if (isset($_POST['send'])) {
    $procesarForm = true;
    if(empty($_POST['num1'])){
        $mensajError = "No se han introducido el numero 1";
        $procesarForm = false;
    }
    elseif(empty($_POST['num2'])){
        $mensajError = "No se han introducido el numero 2";
        $procesarForm = false;
    }
    else{
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $procesarForm = true;
    }
}

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
    <?php
    if ($procesarForm) {
        echo $num1 + $num2;
    } else {
    ?>
        <h1>Suma de dos números</h1>
        <form action="" method="POST">
            <label for="nombre">Numero 1</label>
            <input type="text" name="num1" value="<?php echo $num1; ?>"> <br /> <br />
            <label for="apellidos">Numero 2</label>
            <input type="text" name="num2" value="<?php echo $num2; ?>"> <br /> <br />
            <?php echo $mensajError ?><br /> <br />
            <input type="submit" name="send" value="Send">
        </form>
    <?php
    }
    ?>

</body>

</html>