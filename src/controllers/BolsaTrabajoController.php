<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 30/04/2018
 * Time: 22:20
 */

namespace controllers;

use config\ConfigBolsaTrabajo;
use Faker\Factory;
use model\GenericMessage;
use Respect\Validation\Validator as v;
use servicios\bolsaTrabajo\BolsaTrabajoServicios;
use Teapot\StatusCode\Http;
use utils\bolsaTrabajo\ConstantesBolsaTrabajo;
use utils\bolsaTrabajo\MensajesBT;
use utils\Constantes;
use utils\ConstantesPaginas;
use utils\TwigViewer;


class BolsaTrabajoController
{

    /**
     * Función principal encargada de repartir las operaciones que se realizan en la bolsa de trabajo
     */
    //TODO - en construcción
    public function bolsaTrabajoMain()
    {

        $action = filter_input(INPUT_GET, Constantes::PARAMETER_NAME_ACTION);
        $tarea = filter_input(INPUT_GET, ConstantesBolsaTrabajo::TAREA);
        if (isset($action)) {
            switch ($action) {
                case ConstantesBolsaTrabajo::CREAR_OFERTA_TRABAJO:


                    if (isset($tarea) && $tarea === ConstantesBolsaTrabajo::INSERT) {

                        $datos = filter_input(INPUT_GET, ConstantesBolsaTrabajo::NUEVA_OFERTA);
                        $datos = json_decode($datos);
                        $this->crearOfertaForm($datos);

                    } else if (isset($tarea) && $tarea === ConstantesBolsaTrabajo::UPDATE) {

                        $datos = filter_input(INPUT_GET, ConstantesBolsaTrabajo::UPDATE_OFERTA);
                        $datos = json_decode($datos);
                        $this->updateOfertaForm($datos);

                    } else {
                        $this->crearOfertaVista();
                    }

                    break;
                case ConstantesBolsaTrabajo::VER_OFERTA_TRABAJO:
                    $idOferta = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_OFERTA);
                    if (v::numeric()->validate($idOferta)) {
                        $respnseJson = filter_input(INPUT_GET, ConstantesBolsaTrabajo::RESPONSE_JSON);
                        $this->verOferta($idOferta, (isset($respnseJson)) ? $respnseJson : false);
                    } else {
                        echo json_encode(new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::ERROR_FALLO_IDENTIFICADOR));
                    }

                    break;
                case ConstantesBolsaTrabajo::BORRAR_OFERTA_TRABAJO:
                    $idOferta = filter_input(INPUT_POST, ConstantesBolsaTrabajo::ID_OFERTA);
                    if (v::numeric()->validate($idOferta)) {
                        $this->borrarOferta($idOferta, 10);//TODO - Temporal UserID
                    } else {
                        echo json_encode(new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::ERROR_FALLO_IDENTIFICADOR));
                    }

                    break;

                case ConstantesBolsaTrabajo::MIS_OFERTAS_TRABAJO:
                    $idOwnerOferta = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_OWNER_OFERTA);
                    if (v::numeric()->validate($idOwnerOferta)) {
                        $this->misOferta($idOwnerOferta);
                    } else {
                        $this->irAlIndex();
                    }

                    break;

                case ConstantesBolsaTrabajo::REQUEST_OPERATION_TRABAJO;//Operaciones REST
                    $operacion = filter_input(INPUT_GET, ConstantesBolsaTrabajo::OPERACION);

                    switch ($operacion) {
                        case ConstantesBolsaTrabajo::OFERTA_FP_CODES;
                            $idOferta = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_OFERTA);

                            if (v::numeric()->validate($idOferta)) {
                                $servicios = new BolsaTrabajoServicios();
                                $titulos = $servicios->getOfertaFpTitulo($idOferta);
                                echo json_encode($titulos);
                            }

                            break;
                        case ConstantesBolsaTrabajo::PAGINACION_OFERTAS;

                            $page = filter_input(INPUT_GET, ConstantesBolsaTrabajo::PAGINA_OFERTA);
                            $orden = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ORDEN);
                            $fpId = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_FP);
                            $limit = filter_input(INPUT_GET, ConstantesBolsaTrabajo::LIMIT);

                            $servicios = new BolsaTrabajoServicios();
                            $ofertasFilter = $servicios->getOfertasByFpIdAndTime($limit, $page, $fpId, $orden);

                            echo json_encode($ofertasFilter);

                            break;
                    }


                    break;
                case ConstantesBolsaTrabajo::MI_PERFIL_TRABAJO:
                    $idPerfil = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_PERFIL_PERSONA);
                    if (v::numeric()->validate($idPerfil)) {
                        $this->miPerfil($idPerfil);
                    } else {
                        $this->irAlIndex();
                    }
                    break;
                case ConstantesBolsaTrabajo::EDITAR_PERFIL_TRABAJO:
                    $idPerfil = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_PERFIL_PERSONA);
                    if (v::numeric()->validate($idPerfil)) {
                        $this->editarPerfil($idPerfil);
                    } else {
                        $this->irAlIndex();
                    }
                    break;

            }
        } else {
            $page = ConstantesPaginas::BOLSA_TRABAJO_PAGE;
            //enviar ofertas de trabajo a la vista principal
            $servicios = new BolsaTrabajoServicios();

            $OfertasBundle = (object)[];
            //$OfertasBundle->OFERTAS_DB = $servicios->getAllOfertas(ConfigBolsaTrabajo::NUM_RESULTADOS_OFERTAS, 0,$orden);
            $OfertasBundle->FP_ESTUDIOS = $this->cargarCiclosFP();


            TwigViewer::getInstance()->viewPage($page, (array)$OfertasBundle);

        }
    }


    public function crearOfertaVista()
    {
        $page = ConstantesPaginas::CREAR_OFERTA_PAGE;
        $estudios = $this->cargarCiclosFP();

        TwigViewer::getInstance()->viewPage($page, (array)$estudios);
    }

    public function crearOfertaForm($datos)
    {
        $servicios = new BolsaTrabajoServicios();
        if ($servicios->tratarParametrosOferta($datos)) {
            $datos->id_user_oferta = "10";// TODO - Temporal hasta tener enlace con usuarios
            $newOfertaDB = $servicios->insertNuevaOferta($datos);
            if (is_object($newOfertaDB)) {
                $message = new GenericMessage(MensajesBT::OPERACION_ACEPTADA, MensajesBT::INSERCION_ACEPTADA);
                $message->setLINK(MensajesBT::INSERCION_ACEPTADA_LINK . $newOfertaDB->id_oferta);
                echo json_encode($message);
            }

        } else {
            http_response_code(Http::BAD_REQUEST);
            echo json_encode(new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::INSERCION_DENEGADA));
        }


    }

    public function verOferta($idOferta, $responseJson)
    {
        $servicios = new BolsaTrabajoServicios();
        $ofertaDB = $servicios->verOferta($idOferta);
        if (is_object($ofertaDB)) {
            if ($responseJson == true) {
                echo json_encode($ofertaDB);
            } else {
                $page = ConstantesPaginas::VER_OFERTA_PAGE;
                TwigViewer::getInstance()->viewPage($page, (array)$ofertaDB);
            }
        } else {
            $this->irAlIndex();
        }


    }

    public function misOferta($idOwner)
    {
        $servicios = new BolsaTrabajoServicios();
        //Comprobar que devuelve - pendiente
        $misOfertasDB = $servicios->misOfertas($idOwner);
        //$misOfertasDB = $this->generarMisOfertas();
        $ofertasVista = (object)[];
        $ofertasVista->misOfertas = $misOfertasDB;
        $page = ConstantesPaginas::MIS_OFERTAS_PAGE;
        TwigViewer::getInstance()->viewPage($page, (array)$ofertasVista);

    }

    public function miPerfil($idPerfil)
    {
        $servicios = new BolsaTrabajoServicios();
        //Comprobar que devuelve - pendiente
        $miPerfilDB = $servicios->miPerfil($idPerfil);
        /*$miPerfilDB = $this->generarMisOfertas();
        $ofertasVista = (object)[];
        $ofertasVista->misOfertas = $miPerfilDB;*/
        $page = ConstantesPaginas::MI_PERFIL_PAGE;
        TwigViewer::getInstance()->viewPage($page);

    }

    public function editarPerfil($idPerfil)
    {
        $servicios = new BolsaTrabajoServicios();
        //Comprobar que devuelve - pendiente
        $miPerfilDB = $servicios->miPerfil($idPerfil);
        /*$miPerfilDB = $this->generarMisOfertas();
        $ofertasVista = (object)[];
        $ofertasVista->misOfertas = $miPerfilDB;*/
        $page = ConstantesPaginas::EDITAR_PERFIL_PAGE;
        TwigViewer::getInstance()->viewPage($page);

    }

    public function irAlIndex()
    {
        $page = ConstantesPaginas::INDEX;
        TwigViewer::getInstance()->viewPage($page);
    }


    public function cargarCiclosFP()
    {
        $servicios = new BolsaTrabajoServicios();
        $estudios = (object)[];
        $estudios->FP_ESTUDIOS = $servicios->getEstudiosCentro();
        return $estudios;
    }

    private function updateOfertaForm($datos)
    {
        $servicios = new BolsaTrabajoServicios();
        if ($servicios->tratarParametrosOferta($datos)) {
            //comprobar si devuelve un error
            $ofertaDB = $servicios->actualizarOferta($datos);
            echo json_encode(new GenericMessage(MensajesBT::OPERACION_ACEPTADA, MensajesBT::ACTUALIZACION_ACEPTADA));

        } else {
            echo json_encode(new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::ACTUALIZACION_DENEGADA));
        }

    }

    private function borrarOferta($idOferta, $idOwner)
    {
        $servicios = new BolsaTrabajoServicios();
        if (v::numeric()->validate($idOwner)) {

            if ($servicios->borrarOferta($idOferta, $idOwner)) {
                echo json_encode(new GenericMessage(MensajesBT::OPERACION_ACEPTADA, MensajesBT::BORRAR_ACEPTADA));
            } else {
                echo json_encode(new GenericMessage(MensajesBT::OPERACION_ACEPTADA, MensajesBT::BORRAR_DENEGADA));
            }

        } else {
            echo json_encode(new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::ERROR_FALLO_IDENTIFICADOR_USER));
        }
    }

}//fin clase