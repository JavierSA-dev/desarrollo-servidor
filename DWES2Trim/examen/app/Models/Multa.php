<?php

namespace App\Models;

class Multa extends DBAbstractModel{
    private static $instancia;
    public static function getInstancia(){
        if(!isset(self::$instancia)){
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    private $id;
    private $id_agente;
    private $id_conductor;
    private $matricula;
    private $id_tipo_sanciones;
    private $descripcion;
    private $fecha;
    private $importe;
    private $descuento;
    private $estado;


    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    // getters y setters
    public function setIdAgente($id_agente){
        $this->id_agente = $id_agente;
    }

    public function getIdAgente(){
        return $this->id_agente;
    }

    public function setIdConductor($id_conductor){
        $this->id_conductor = $id_conductor;
    }

    public function getIdConductor(){
        return $this->id_conductor;
    }

    public function setMatricula($matricula){
        $this->matricula = $matricula;
    }

    public function getMatricula(){
        return $this->matricula;
    }

    public function setIdTipoSanciones($id_tipo_sanciones){
        $this->id_tipo_sanciones = $id_tipo_sanciones;
    }

    public function getIdTipoSanciones(){
        return $this->id_tipo_sanciones;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setImporte($importe){
        $this->importe = $importe;
    }

    public function getImporte(){
        return $this->importe;
    }

    public function setDescuento($descuento){
        $this->descuento = $descuento;
    }

    public function getDescuento(){
        return $this->descuento;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function getNumberSanctionsById($id){
        $this->query = "SELECT COUNT(*) FROM multas WHERE id_conductor = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }



    public function __clone(){
        trigger_error("La clonación no es permitida!", E_USER_ERROR);
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function getRows(){
        return $this->rows;
    }

    // getALL
    public function getAll(){
        $this->query = "SELECT * FROM usuarios";
        $this->get_results_from_query();
        return $this->rows;
    }

    // getAllNombreConductoresS
    public function getAllNombreConductores(){
        $this->query = "SELECT nombre, id FROM usuarios WHERE perfil = 'conductor'";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getPuntosById($id){
        $this->query = "SELECT puntos FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }



    // getImporteByTipo
    public function getImporteByTipo($id){
        $this->query = "SELECT importe FROM tipo_sanciones WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getAllByIdConductor($id_conductor){
        $this->query = "SELECT * FROM multas WHERE id_conductor = :id_conductor";
        $this->parametros['id_conductor'] = $id_conductor;
        $this->get_results_from_query();
        return $this->rows;
    }

    // getAllByIdAgente
    public function getAllByIdAgente($id_agente){
        $this->query = "SELECT * FROM multas WHERE id_agente = :id_agente";
        $this->parametros['id_agente'] = $id_agente;
        $this->get_results_from_query();
        return $this->rows;
    }


    public function getById(){
        $this->query = "SELECT * FROM multas WHERE id = :id AND id_conductor = :id_conductor";
        $this->parametros['id'] = $this->id;
        $this->parametros['id_conductor'] = $this->id_conductor;
        $this->get_results_from_query();
        return $this->rows;
    }

    // getConductorById
    public function getConductorById($id_conductor){
        $this->query = "SELECT nombre FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $id_conductor;
        $this->get_results_from_query();
        return $this->rows;
    }

    // getTipoSancionById
    public function getTipoSancionById($id_tipo_sanciones){
        $this->query = "SELECT tipo FROM tipo_sanciones WHERE id = :id";
        $this->parametros['id'] = $id_tipo_sanciones;
        $this->get_results_from_query();
        return $this->rows;
    }

    // update
    public function update(){
        $this->query = "UPDATE multas SET importe = :importe, descuento = :descuento, estado = :estado WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->parametros['importe'] = $this->importe;
        $this->parametros['descuento'] = $this->descuento;
        $this->parametros['estado'] = $this->estado;
        $this->get_results_from_query();
        $this->mensaje = "Multas actualizada";
    }

    public function getAllMultas(){
        $this->query = "SELECT * FROM multas";
        $this->get_results_from_query();
        return $this->rows;
    }

    // getCoeficienteById Devuelve el porcentaje de multas que ha puesto el agente con ese id respeto al total de multa
    public function getCoeficienteById($id_agente){
        $total = count($this->getAllMultas());
        $mismultas = count($this->getAllByIdAgente($id_agente));
        $cantidad_restante = $total - $mismultas;
        return 100 - (($cantidad_restante / $total) * 100);
    }

    public function get(){}

    public function set(){
        $this->query = "INSERT INTO multas (id_agente, id_conductor, matricula, id_tipo_sanciones, descripcion, fecha, importe, descuento, estado) VALUES (:id_agente, :id_conductor, :matricula, :id_tipo_sanciones, :descripcion, :fecha, :importe, :descuento, :estado )";
        $this->parametros['id_agente'] = $this->id_agente;
        $this->parametros['id_conductor'] = $this->id_conductor;
        $this->parametros['matricula'] = $this->matricula;
        $this->parametros['id_tipo_sanciones'] = $this->id_tipo_sanciones;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['fecha'] = $this->fecha;
        $this->parametros['importe'] = $this->importe;
        $this->parametros['descuento'] = $this->descuento;
        $this->parametros['estado'] = $this->estado;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario agregado exitosamente';
    }

    public function edit(){}

    public function delete(){}


}