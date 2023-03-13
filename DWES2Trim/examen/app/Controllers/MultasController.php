<?php

namespace App\Controllers;

use App\Models\Receta;
use App\Models\Usuario;
use App\Models\Multa;

class MultasController extends BaseController
{
    public function indexAction()
    {
        if (isset($_POST['auth'])) {
            AuthController::login($_POST);
        } else {
            $this->renderHTML('../views/index_view.php');
        }
    }

    public function adminAction()
    {

        if ($_SESSION['auth'] !== "admin") {
            header('Location: http://examen.localhost/');
        }
        if (isset($_POST['restart'])) {
            $multa = Multa::getInstancia();
            $conductor = Usuario::getInstancia();
            $conductor->resetPuntos($_POST['id']);
            $conductor->getAllConductores();
            $data = array('conductores' => $conductor->getRows());
            foreach ($data['conductores'] as $key => $value) {
                $multa->getNumberSanctionsById($value['id']);
                $data['conductores'][$key]['sanciones'] = $multa->getRows()[0]['COUNT(*)'];
            }
            $this->renderHTML('../views/admin_view.php', $data);
        }else if (isset($_POST['searcher'])) {
            $conductor = Usuario::getInstancia();
            $multa = Multa::getInstancia();
            $conductor->searchConductorsByName($_POST['nombre']);
            $data = array('conductores' => $conductor->getRows());
            foreach ($data['conductores'] as $key => $value) {
                $multa->getNumberSanctionsById($value['id']);
                $data['conductores'][$key]['sanciones'] = $multa->getRows()[0]['COUNT(*)'];
            }
            $this->renderHTML('../views/admin_view.php', $data);
        }else{
            $conductor = Usuario::getInstancia();
            $multa = Multa::getInstancia();
            $conductor->getAllConductores();
    
            $data = array('conductores' => $conductor->getRows());
            foreach ($data['conductores'] as $key => $value) {
                $multa->getNumberSanctionsById($value['id']);
                $data['conductores'][$key]['sanciones'] = $multa->getRows()[0]['COUNT(*)'];
            }
    
            $this->renderHTML('../views/admin_view.php', $data);
        }


    }


    public function listmultasAction()
    {

        if ($_SESSION['auth'] === 'conductor') {
            $multa = Multa::getInstancia();
            $multa->getAllByIdConductor($_SESSION['user'][0]['id']);
            $data = array('multas' => $multa->getRows());
            $this->renderHTML('../views/list_multa_view.php', $data);
        }
        else if ($_SESSION['auth'] == 'agente') {
            $multa = Multa::getInstancia();
            $_SESSION['coeficiente'] = $multa->getCoeficienteById($_SESSION['user'][0]['id']);

            $multa->getAllByIdAgente($_SESSION['user'][0]['id']);
            $multa->getCoeficienteById($_SESSION['user'][0]['id']);
            $data = array('multas' => $multa->getRows());
            $this->renderHTML('../views/list_multa_view.php', $data);
        }else
        {
            header('Location: http://examen.localhost/');
        }
    }

    public function addMultaAction()
    {

        if ($_SESSION['auth'] !== "agente") {
            header('Location: http://examen.localhost/');
        } else {
            if (isset($_POST['add'])) {
                $multa = Multa::getInstancia();
                $usuario = Usuario::getInstancia();
                $multa->setIdAgente($_POST['id_agente']);
                $multa->setIdConductor($_POST['id_conductor']);
                $multa->setMatricula($_POST['matricula']);
                $multa->setIdTipoSanciones($_POST['id_tipo_sanciones']);
                $multa->setDescripcion($_POST['descripcion']);
                $multa->setFecha($_POST['fecha']);
                $importe = $multa->getImporteByTipo($_POST['id_tipo_sanciones']);
                $multa->setImporte($importe[0]['importe']);
                $multa->setDescuento(0);
                $multa->setEstado("Pendiente");
                $puntos = $usuario->getPuntosByImporte($importe[0]['importe']);
                $usuario->setId($_POST['id_conductor']);
                $usuario->setPuntos($usuario->getPuntosById($_POST['id_conductor']));
                $usuario->sumarPuntos($puntos[0]['puntos']);
                $multa->set();
                header('Location: http://examen.localhost/listmultas');
            } else {
                $multa = Multa::getInstancia();
                $_SESSION['coeficiente'] = $multa->getCoeficienteById($_SESSION['user'][0]['id']);

                $multa->getAllNombreConductores();
                $data = array('conductores' => $multa->getRows());
                $this->renderHTML('../views/add_multa_view.php', $data);
            }
        }
    }

    public function pagarAction($ruta)
    {
        if ($_SESSION['auth'] !== "conductor") {
            header('Location: http://examen.localhost/');
        }else{
            if (isset($_POST['pagar'])) {
                $multa = Multa::getInstancia();
    
                $multa->setId($_POST['idmulta']);
                $multa->setEstado('Pagada');
                $multa->setImporte($_POST['importe']);
                $multa->setDescuento($_POST['bonificacion']);
                $multa->update();
                header('Location: http://examen.localhost/listmultas');
            } else {
                $multa = Multa::getInstancia();
                $idReceta = explode('/', $ruta)[2];
                $multa->setId($idReceta);
                $multa->setIdConductor($_SESSION['user'][0]['id']);
                $multa->getById();
                $data = array('multa' => $multa->getRows());
                if (count($data['multa']) == 0) {
                    $_SESSION['error'] = "No existe la multa";
                    header('Location: http://examen.localhost/listmultas');
                }
                $data['conductor'] = $multa->getConductorById($data['multa'][0]['id_conductor']);
                $data['tipo_sancion'] = $multa->getTipoSancionById($data['multa'][0]['id_tipo_sanciones']);
                $this->renderHTML('../views/pagar_view.php', $data);
            }
        }

    }
}
