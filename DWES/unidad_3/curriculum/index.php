<?php

function clear_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$name = $email = $gender = $comment = $website = "";
$nameErr = $emailErr = $websiteErr = "";

$aGenero = array("Hombre", "Mujer", "Otro");
$genderErr = "";

$aVehiculos = array("Coche", "Moto", "Bicicleta");
$vehiculosSeleccionados = array();

$aOpciones = array(
    array("valor" => 1, "texto" => "Opción 1"),
    array("valor" => 2, "texto" => "Opción 2"),
    array("valor" => 3, "texto" => "Opción 3"),
    array("valor" => 4, "texto" => "Opción 4"),
);
$opcionSeleccionada = 1;

$cars = array("Volvo", "BMW", "Toyota");

$carsSeleccionados = array();

$lprocesaformulario = false;
$lerror = false;
if (isset($_POST["send"])) {
    print_r($_POST);
    $lprocesaformulario = true;
    if (empty($_POST["nombre"])) {
        $nameErr = "Name is required";
        $lerror = true;
    } else {
        $name = clear_input($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $lerror = true;
    } else {
        $email = clear_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $lerror = true;
        }
    }
    if (empty($_POST["website"])) {
        $websiteErr = "Url is required";
        $lerror = true;
    }
    $name = clear_input($_POST["nombre"]);
    $email = clear_input($_POST["email"]);
    $website = clear_input($_POST["website"]);
    $comment = clear_input($_POST["comentario"]);
    $gender = clear_input($_POST["genero"]);
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
    <h1>Curriculum</h1>
    <form action="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value=<?php echo $name ?>>
        <div style="display: inline-block;"><?php echo $nameErr ?></div>
        <br>
        <br>
        <label for="email">email</label>
        <input type="email" name="email" id="email" value=<?php echo $email ?>>
        <div style="display: inline-block;"><?php echo $emailErr ?></div>
        <br>
        <br>
        <label for="url">Url</label>
        <input type="url" name="website" id="url" value=<?php echo $website?>>
        <div style="display: inline-block;"><?php echo $websiteErr ?></div>
        <br>
        <br>
        <label for="comentario">Comentario</label>
        <textarea name="comentario" id="comentario" cols="30" rows="10" ><?php echo $comment  ?></textarea>
        <br>
        <br>
        <label for="genero">Genero</label>
        <input type="radio" name="genero" id="genero" value="hombre" <?php if (isset($_POST['radio']) && $_POST['radio'] ==  'no'): ?>checked='checked'<?php endif; ?>>Hombre
        <input type="radio" name="genero" id="genero" value="mujer">Mujer
        <input type="radio" name="genero" id="genero" value="otro">Otro
        <br>
        <br>
        <label for="transporte">Transporte</label>
        <input type="checkbox" name="transporte" id="transporte" value="">Coche
        <input type="checkbox" name="transporte" id="transporte" value="">Moto
        <input type="checkbox" name="transporte" id="transporte" value="">Bicicleta
        <br>
        <br>
        <label for="opciones">Selecciona una opción</label>
        <select name="opciones" id="opciones">
            <option value="1">Opción 1</option>
            <option value="2">Opción 2</option>
            <option value="3">Opción 3</option>
        </select>
        <br>
        <br>
        <label for="mulsel">Seleccion multiple</label>
        <select name="mulsel" id="mulsel" multiple>
            <option value="opcion1">Renault</option>
            <option value="opcion2">Citroen</option>
            <option value="opcion3">Volvo</option>
        </select>
        <br>
        <br>
        <input type="submit" name="send" value="Enviar">
    </form>

</body>

</html>