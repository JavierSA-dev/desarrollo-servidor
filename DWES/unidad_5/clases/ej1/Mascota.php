<?php 

class Mascota
{
    public static function getName()
    {
        echo "Soy una mascota";
    }
    public static function whoami()
    {
        echo " una mascota";
    }
}

class Perro extends Mascota
{
    public static function getName()
    {
        echo "Soy un perro";
    }
}

Perro::whoami();