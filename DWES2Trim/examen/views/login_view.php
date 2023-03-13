<h2>Datos de Acceso</h2>
<form action="" method="post">
    <label for="user">Usuario</label>
    <input type="text" name="user" id="user">
    <label for="pass">Contraseña</label>
    <input type="password" name="pass" id="pass">
    <?php

    $formas = ["<div style='background-color: red; width: 100px; height: 100px;'></div>", "<div style='background-color: red; width: 100px; height: 100px;  border-radius: 50%'></div>", "<div style='background-color: white; width: 0; height: 0;  border-left: 50px solid transparent; border-right: 50px solid transparent; border-bottom: 100px solid red;'></div>"];

    $randonNUmber = random_int(0, 2);

    echo $formas[$randonNUmber];

    ?>
    <input type="radio" name="forma" id="cuadrado" value="0">
    <label for="forma">Cuadrado</label>
    <input type="radio" name="forma" id="circulo" value="1">
    <label for="forma">Circulo</label>
    <input type="radio" name="forma" id="triangulo" value="2">
    <label for="forma">Triangulo</label>
    <br>
    <input type="hidden" name="formaCorrecta" value="<?php echo $randonNUmber; ?>">

    <input type="submit" name="auth" value="Enviar">
</form>