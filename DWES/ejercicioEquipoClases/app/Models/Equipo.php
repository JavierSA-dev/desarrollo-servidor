<?php
namespace App\Models;

use DateTime;

class Equipo extends DBAbstractModel{
    
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

    private $equipo;
    private $id;
    private $created_at;
    private $updated_at;

    public function setEquipo($equipo){
        $this->equipo = $equipo;
    }


    public function getMensaje(){
        return $this->mensaje;
    }

    function set(){
        $this->query = "INSERT INTO equipos(equipo) VALUES(:equipo)";
        $this->parametros["equipo"] = $this->equipo;
        $this->mensaje = $this->get_results_from_query() ? "Equipo añadido" : "No se pudo añadir";
    }
    function getAll()
    {
        $this->query = "SELECT * FROM equipos";
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'sh encontrado';
        }
        else {
            $this->mensaje = 'sh no encontrado';
        }
        return $this->rows;
    }
    function get($equipo = ""){
        if($equipo != '') {
            $this->query = "SELECT *
            FROM equipos
            WHERE equipo LIKE :equipo";
            //Cargamos los parámetros.
            $this->parametros['equipo']= "%$equipo%";
            //Ejecutamos consulta que devuelve registros.
            $this->get_results_from_query();
        }
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
            $this->$propiedad = $valor;
            }
            $this->mensaje = 'sh encontrado';
        }
        else {
            $this->mensaje = 'sh no encontrado';
        }
        return $this->rows;
    }

    function getEquipoById($id = ""){
        if($id != '') {
            $this->query = "SELECT *
            FROM equipos
            WHERE id LIKE :id";
            //Cargamos los parámetros.
            $this->parametros['id']= $id;
            //Ejecutamos consulta que devuelve registros.
            $this->get_results_from_query();
        }
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
            $this->$propiedad = $valor;
            }
            $this->mensaje = 'sh encontrado';
        }
        else {
            $this->mensaje = 'sh no encontrado';
        }
        return $this->rows;
    }

    function getPerfil($data)
    {
        $this->query = "SELECT perfil FROM usuarios where user = :user and password = :password";
        $this->parametros["user"] = $data["user"];
        $this->parametros["password"] = $data["password"];
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'sh encontrado';
        }
        else {
            $this->mensaje = 'sh no encontrado';
        }
        return $this->rows;   
    }

    function edit($data = array()){
        foreach ($data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = 
        "UPDATE equipos set equipo=:equipo, updated_at=:updated_at where id = :id";
        $this->parametros["equipo"] = $equipo;
        $mFormat="Y/m/d H:i";
        $mDate = new DateTime();
        $this->updated_at = $mDate->format($mFormat);
        $this->parametros["updated_at"] = $this->updated_at;
        $this->get_results_from_query();
        $this->mensaje = "sh modificado";
    }
     function delete($id = ""){
        $this->query = "DELETE FROM equipos WHERE id = :id";
        $this->parametros["id"] = $id;
        $this-> get_results_from_query();
        $this-> mensaje = "sh eliminado";
    }
}


?>