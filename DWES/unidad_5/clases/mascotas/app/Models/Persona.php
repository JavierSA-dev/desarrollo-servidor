<?php

namespace App\Models;
class Persona
{
    private $_nombre;
    private $_apellido1;
    private $_apellido2;

    public function __construct($nombre, $_apellido1, $_apellido2)
    {
        $this->_nombre = $nombre;
        $this->_apellido1 = $_apellido1;
        $this->_apellido2 = $_apellido2;
    }

    public function __destruct()
    {
        echo $this->_nombre . "destruido";
    }

    public function saluda(){
        echo "Hola MUndo";
    }

    public function Nombre(){
        return $this->_nombre;
    }
}