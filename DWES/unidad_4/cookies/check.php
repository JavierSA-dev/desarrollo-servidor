<?php 
    echo (isset($_COOKIE['usuario']) && $_COOKIE['usuario']=='javier') ? 'Las cookies están activadas' : 'Las cookies están desactivadas';