<?php
class Contador
{
    public $contador = 0;
    private static $numContadores = 0;

    public function __construct()
    {
        self::$numContadores++;
    }
    public function incrementar()
    {
        $this->contador++;
    }
    public static function getNumContadores()
    {
        return self::$numContadores;
    }
    public function getContador()
    {
        return $this->contador++;
    }
}
