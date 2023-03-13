<?php
/**
 * formulario de login que permita al usuario recordar los datos introducidos. Incluye una 
 * opción para borrar la información almacenada.
 * @author Hugo Vicente Peligro
 */

$procesaFormulario = false;
$usuario = "";
$password = "";
if(isset($_COOKIE["user"])){
    $usuario = $_COOKIE["user"];
    $password = $_COOKIE["contraseña"];
}

if (isset($_POST["enviar"])) {
    if($_POST["usuario"] == "usuario" && $_POST["contraseña"] == "1234"){
        $procesaFormulario = true;
        if(isset($_POST["recordar"])){
            setcookie("user",$_POST["usuario"],time()+3600);
            setcookie("contraseña",$_POST["contraseña"],time()+3600);
        }
        else{//Si no le das a recordar borras las cookies 
            setcookie("user",$_POST["usuario"],time()-3600);
            setcookie("contraseña",$_POST["contraseña"],time()-3600);
        }
    }
}
/*if(isset($_POST["eliminar"])){
setcookie("usuario", $_POST["usuario"],time()-2);
setcookie("contraseña", $_POST["contraseña"],time()-2);
print_r($_COOKIE);
}*/


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
    if($procesaFormulario){
        echo "Acceso autorizado ";
    }
    else{
        ?>
        <form action="" method="POST">
        <input type="text" name="usuario" value="<?php echo $usuario; ?>">
        <input type="password" name="contraseña" value="<?php echo $password; ?>">
        <label >Recordar</label>
        <input type="checkbox" name="recordar">
        <input type="submit" name="enviar">
        
    </form>
        <?php
    }
    ?>
    
    



</body>
</html>