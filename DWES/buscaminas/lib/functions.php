<?php

include('./config/config.php');
include('../config/config.php');

function crearTablero($filas, $columnas, $minas)
{
    $tablero = array();
    for ($i = 0; $i < $filas; $i++) {
        $tablero[$i] = array();
        for ($j = 0; $j < $columnas; $j++) {
            $tablero[$i][$j] = 0;
        }
    }
    for ($i = 0; $i < $minas; $i++) {
        do {
            $fila = rand(0, $filas - 1);
            $columna = rand(0, $columnas - 1);
        } while ($tablero[$fila][$columna] == 9);
        $tablero[$fila][$columna] = 9;
        for ($f = max(0, $fila - 1); $f <= min($filas - 1, $fila + 1); $f++) {
            for ($c = max(0, $columna - 1); $c <= min($columnas - 1, $columna + 1); $c++) {
                if ($tablero[$f][$c] != 9) {
                    $tablero[$f][$c]++;
                }
            }
        }
    }

    return $tablero;
}

function mostrarTablero($tablero)
{
    foreach ($tablero as $fila) {
        foreach ($fila as $casilla) {
            echo $casilla . " ";
        }
        echo "<br>";
    }
}

function clickCasilla($fila, $columna)
{
    if ($_SESSION['tableroVisible'][$fila][$columna] == 0) {
        $_SESSION['tableroVisible'][$fila][$columna] = 1;
        $_SESSION['contador']++;
        if ($_SESSION['tablero'][$fila][$columna] == 9) {
            return 0;
            header("Location: log_out.php");
        } else if ($_SESSION['contador'] == (N_FILAS * N_COLUMNAS) - N_MINAS) {
            return 1;
            header("Location: log_out.php");
        } else {
            if ($_SESSION['tablero'][$fila][$columna] == 0) {
                for ($f = max(0, $fila - 1); $f <= min(N_FILAS - 1, $fila + 1); $f++) {
                    for ($c = max(0, $columna - 1); $c <= min(N_COLUMNAS - 1, $columna + 1); $c++) {
                        clickCasilla($f, $c);
                    }
                }
            }
        }
    }
}

function mostrarTableroVisible($tableroVisible)
{
    for ($i = 0; $i < N_FILAS; $i++) {
        for ($j = 0; $j < N_COLUMNAS; $j++) {
            if ($tableroVisible[$i][$j] == 0) {
                echo "<a href='index.php?fila=$i&columna=$j'>" . $tableroVisible[$i][$j] . "</a>";
            } else if ($tableroVisible[$i][$j] == 1) {
                if ($_SESSION['tablero'][$i][$j] == 0) {
                    echo "*";
                } else {
                    echo $_SESSION['tablero'][$i][$j];
                }
            }
        }
        echo "<br>";
    };
}

$tablero = crearTablero(N_FILAS, N_COLUMNAS, N_MINAS);
