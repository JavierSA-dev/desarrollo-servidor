<?php

/**
 * @author Hugo Vicente Peligro
 */
include("./config/config.php");

$procesaFormulario = false;
if (isset($_FILES["file"]["name"])) {
    $temp = explode(".", $_FILES["file"]["name"]); //array nombre del fichero
    $extension = end($temp);
    if (($_FILES["file"]["size"] < MAXSIZE) &&
        in_array($_FILES["file"]["type"], $formatoPermitido) &&
        in_array($extension, $extensiones)
    ) {
        $procesaFormulario = true;

        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"];
        } else {
            $fileName = $_FILES["file"]["name"];
            $fileName = uniqid() . "." . pathinfo($fileName, PATHINFO_EXTENSION);
            echo "Upload: " . $_FILES["file"]["name"] . "<br/>";
            echo "Type: " . $_FILES["file"]["type"] . "<br/>";

            echo "Size: " . ($_FILES["file"]["size"] / 1024) . "kB <br/>";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br/>";
            if (file_exists(DIRUPLOAD.$fileName)) {
                echo $_FILES["file"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], DIRUPLOAD . $fileName);
                echo "Stored in: " .DIRUPLOAD.$fileName;
            }
            echo "<br/>";
            echo "<a href=" . $_SERVER['HTTP_REFERER'] . ">Volver</a><br/>"; // No se recomienda.
            echo '<a href="javascript:history.back()">Volver</a><br/>'; // Mejor.
            
            
            
        }
    } else {
        echo "Invalid file";
    }
}

// Cargar el nombre de los ficheros en el array

$directorio = "upload/";
$imagenes = array();
foreach (scandir($directorio) as $key => $value) {
    if (@exif_imagetype(DIRUPLOAD.$value)) {
        $imagenes[] = DIRUPLOAD.$value;
    }
}






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagenes</title>
</head>

<body>
    <?php
    if (!$procesaFormulario) {
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        Subida de ficheros:
        <input type="file" name="file">
        <input type="submit" value="Enviar">
    </form>
    <?php   
    }
    
    ?>
    <?php
    foreach ($imagenes as $key => $value) {
        echo "<img src=\"$value\" alt></img>";
    }

   


    ?>


    
    
</body>

</html>