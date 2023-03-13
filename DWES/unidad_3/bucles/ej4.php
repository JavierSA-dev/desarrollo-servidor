<?php
/**
* Tabla de colores con enlace a página de fondo de el color seleccionado.
* @author Javier Sánchez López
*/ 


echo "<link rel='stylesheet' type='text/css' href='css/styles2.css'>";
echo "<table border='1' width='100%'>";

for ($r=0; $r <= 255 ; $r+=50) { 
    echo "<tr>";
    for ($g=0; $g < 255 ; $g+=50) { 
        echo "<tr>";

        for ($b=0; $b < 255; $b+=50) { 
            echo "<td>";
            echo "<div style=\" background: rgb($r, $g, $b)\"><a target=\"_blank\" href=fondo.php?color=rgb($r,$g,$b)>".fromRGB($r,$g,$b) ."</a></div>";
            echo "</td>";
        }
        echo "</tr>";

    }
    echo "</tr>";
};


echo "</table>";
function fromRGB($R, $G, $B)
{

    $R = dechex($R);
    if (strlen($R)<2)
    $R = '0'.$R;

    $G = dechex($G);
    if (strlen($G)<2)
    $G = '0'.$G;

    $B = dechex($B);
    if (strlen($B)<2)
    $B = '0'.$B;

    return '#' . $R . $G . $B;
}
?>

<a href="https://github.com/JavierSA-dev/Desarrollo-Web-en-Entorno-Servidor/blob/master/unidad_3/bucles/ej4.php" target="_blank" >Ir al repositorio</a>