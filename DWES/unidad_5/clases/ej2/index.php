<?php

include "Contador.php";

for ($i = 0; $i < 5; $i++) {
    echo "Creo contador $i";
    echo "<br>";
    $c = new Contador();
    for ($f = 0; $f < rand(1, 10); $f++) {
        echo "Incremento contador $i";
        echo "<br>";
        $c->incrementar();
        echo "El contador $i vale: " . $c->getContador();
        echo "<br>";
    }
}

echo "Contadores creados: " . Contador::getNumContadores();

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
    <a href="https://github.com/JavierSA-dev/Desarrollo-Web-en-Entorno-Servidor/blob/master/unidad_4/clases/ej2/">Github</a>
</body>
</html>