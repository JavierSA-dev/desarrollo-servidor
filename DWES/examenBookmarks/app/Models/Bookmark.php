<?php
namespace App\Models;

use DateTime;

class Bookmark extends DBAbstractModel{
    
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
        $this->query = "SELECT * FROM bookmarks";
        $this->get_results_from_query();
        if(count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Bookmark encontrado';
        }
        else {
            $this->mensaje = 'Bookmark no encontrado';
        }
        return $this->rows;
    }
    function get(){}

    function getByUserId($id){
        $this->query = "SELECT * FROM bookmarks WHERE idUsuario = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    function getBookmarkByid($id){
        $this->query = "SELECT * FROM bookmarks WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    function add($data){
        foreach ($data as $campo=>$valor) {
            $$campo = $valor;
        }
        $this->query = "INSERT INTO bookmarks (bm_url, descripcion, idUsuario) VALUES (:bm_url, :descripcion, :idUsuario )";
        $this->parametros["bm_url"] = $bm_url;
        $this->parametros["descripcion"] = $descripcion;
        $this->parametros["idUsuario"] = $idUsuario;
        $this->get_results_from_query();
        $this->mensaje = "Bookmark añadido";
    }

    function edit($data = array()){
        foreach ($data as $campo=>$valor) {
            $$campo = $valor;
        }
        $this->query = "UPDATE bookmarks SET bm_url = :bm_url, descripcion = :descripcion WHERE id = :id ";
        $this->parametros["bm_url"] = $bm_url;
        $this->parametros["descripcion"] = $descripcion;
        $this->parametros["id"] = $id;
        $this->get_results_from_query();
        $this->mensaje = "Bookmark actualizado";

    }
     function delete($id = ""){
        $this->query = "DELETE FROM bookmarks WHERE id = :id ";
        $this->parametros["id"] = $id;
        $this->get_results_from_query();
        $this->mensaje = "Bookmark borrado";

    }
}


?>