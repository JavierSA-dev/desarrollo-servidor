<?php
/**
 * Respuesta del formulario
 * @author Javier Sánchez López
 */
    foreach ($_POST as $key => $value) {
        if ($key != "send") {
            echo "$key: $value <br/>";
        }
    }

?>