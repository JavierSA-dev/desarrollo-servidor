<?php 

$fp = fopen("poema.txt", "r");
while (!feof($fp)) {
    $linea = fgets($fp);
    echo $linea;
    echo "<br>";
}

echo "<br>";

$fp = fopen("poema.txt", "r");
$fp2 = fopen("poema2.txt", "w");
while (!feof($fp)) {
    $linea = fgets($fp);
    $linea = mb_strtoupper($linea);
    fputs($fp2, $linea);
    echo $linea;
    echo "<br>";
}

fclose($fp);
?>