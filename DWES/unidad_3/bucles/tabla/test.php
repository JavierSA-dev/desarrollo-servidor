<?php

include_once('include/functions.php');

$aTest = array(
    array('f' => 1, 'c' => 1),
    array('f' => 5, 'c' => 2),
    array('f' => 9, 'c' => 7),
);

echo existeCoordenada(1, 50, $aTest) ? 'true' : 'false';
