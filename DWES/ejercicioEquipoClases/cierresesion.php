<?php
session_start();
session_destroy();
unset($_SESSION["usuario"]);
unset($_SESSION["perfil"]);
header("Location: ./public/index.php");
?>