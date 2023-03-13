<?php

namespace App\Models;

class Usuario extends DBAbstractModel
{
    private static $instancia;
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    private $id;
    private $user;
    private $passwd;
    private $nombre;
    private $perfil;
    private $puntos;
    private $sanciones;

    // getters y setters

    public function getSanciones()
    {
        return $this->sanciones;
    }

    public function setSanciones($sanciones)
    {
        $this->sanciones = $sanciones;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getuser()
    {
        return $this->user;
    }

    public function setUser($usuario)
    {
        $this->user = $usuario;
    }

    public function getpasswd()
    {
        return $this->passwd;
    }

    public function setpasswd($password)
    {
        $this->passwd = $password;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getPerfil()
    {
        return $this->perfil;
    }

    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    }


    public function getPuntos()
    {
        return $this->puntos;
    }

    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;
    }




    public function __clone()
    {
        trigger_error("La clonación no es permitida!", E_USER_ERROR);
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function exists(){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :user AND password = :passwd";
        $this->parametros['user'] = $this->user;
        $this->parametros['passwd'] = $this->passwd;
        $this->get_results_from_query();
        if(count($this->rows) == 1){
            return $this->rows;
        }else{
            return false;
        }
    }

    public function getPuntosByImporte($importe) {
        $this->query = "SELECT puntos FROM tipo_sanciones WHERE importe = :importe";
        $this->parametros['importe'] = $importe;
        $this->get_results_from_query();
        return $this->rows;
    }

    // getPuntosById
    public function getPuntosById($id){
        $this->query = "SELECT puntos FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    // sumarPuntos
    public function sumarPuntos($puntosAsumar){
        $this->query = "UPDATE usuarios SET puntos = puntos + :puntosAsumar WHERE id = :id";
        $this->parametros['puntosAsumar'] = $puntosAsumar;
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getAllConductores(){
        $this->query = "SELECT * FROM usuarios WHERE perfil = 'conductor'";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function searchConductorsByName($nombre){
        $this->query = "SELECT * FROM usuarios WHERE perfil = 'conductor' AND nombre LIKE :nombre";
        $this->parametros['nombre'] = "%".$nombre."%";
        $this->get_results_from_query();
        return $this->rows;
    }

    // resetPuntos
    public function resetPuntos($arrayIDs){
        $this->query = "UPDATE usuarios SET puntos = 0 WHERE id IN (".implode(",",$arrayIDs).")";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function get()
    {
    }

    public function set()
    {
    }

    public function edit()
    {
    }

    public function delete($id = '')
    {
    }
}
