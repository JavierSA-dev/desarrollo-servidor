<?php
namespace App\Models;

use DateTime;

class Usuarios extends DBAbstractModel{
    
    private static $instancia;
    public static function getInstancia(){
        if(!isset(self::$instancia)){
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function __clone(){
        trigger_error("La clonación no es permitida!", E_USER_ERROR);
    }


    public function getMensaje(){
        return $this->mensaje;
    }

    function set(){}

    function getAll()
    {
        $this->query = "SELECT * FROM usuarios";
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Usuario encontrado';
        }
        else {
            $this->mensaje = 'Usuario no encontrado';
        }
        return $this->rows;
    }
    function get(){
    }

    function desbloquearByArrayIds($data)
    {
        $this->query = "UPDATE usuarios SET bloqueado = 0 WHERE id IN (".implode(",",$data).")";
        $this->get_results_from_query();
        $this->mensaje = "Usuario modificado";
    }

    function getByUserPassword($data)
    {
        $this->query = "SELECT * FROM usuarios where user = :user and psw = :psw";
        $this->parametros["user"] = $data["user"];
        $this->parametros["psw"] = $data["psw"];
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Usuario encontrado';
        }
        else {
            $this->mensaje = 'Usuario no encontrado';
        }
        return $this->rows;   
    }

    function getPerfil($data)
    {
        $this->query = "SELECT perfil FROM usuarios where user = :user and psw = :psw";
        $this->parametros["user"] = $data["user"];
        $this->parametros["psw"] = $data["psw"];
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Usuario encontrado';
        }
        else {
            $this->mensaje = 'Usuario no encontrado';
        }
        return $this->rows;   
    }

    function isbBloqued($data)
    {
        $this->query = "SELECT bloqueado FROM usuarios where user = :user";
        $this->parametros["user"] = $data["user"];
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Usuario encontrado';
        }
        else {
            $this->mensaje = 'Usuario no encontrado';
        }
        return $this->rows;   
    }

    function edit(){
    }
     function delete(){
    }
}
