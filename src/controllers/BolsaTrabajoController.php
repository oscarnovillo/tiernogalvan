<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 30/04/2018
 * Time: 22:20
 */

namespace controllers;

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

                //Operaciones REST
                case ConstantesBolsaTrabajo::REQUEST_OPERATION_TRABAJO;
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
                        case ConstantesBolsaTrabajo::PAGINACION_SIZE;
                            $servicios = new BolsaTrabajoServicios();
                            echo json_encode($servicios->getSizeOfertas());

                            break;
                        case ConstantesBolsaTrabajo::UPLOAD_FILE:

                            $servicios = new BolsaTrabajoServicios();
                            $servicios->subirArchivo();

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

                    if (isset($tarea) && $tarea === ConstantesBolsaTrabajo::UPDATE) {

                        $datos = filter_input(INPUT_GET, ConstantesBolsaTrabajo::EDITAR_PERFIL_TRABAJO);
                        $datosConfig = filter_input(INPUT_GET, ConstantesBolsaTrabajo::EDITAR_PERFIL_TRABAJO_CONFIG);
                        if ($datos != null) {
                            $datos = json_decode($datos);
                            $datos->ID_PERFIL = 1;//TODO - Temporal - recuperar Id del alumno de session
                            $this->insertOrUpdatePerfilForm($datos);
                        } elseif ($datosConfig != null) {
                            $datosConfig = json_decode($datosConfig);
                            $datosConfig->ID_PERFIL = 1;//TODO - Temporal - recuperar Id del alumno de session
                            $this->insertOrUpdatePerfilFormConfig($datosConfig);
                        }


                    } else {
                        $this->editarPerfilVista();
                    }
                    break;

            }
        } else {
            $page = ConstantesPaginas::BOLSA_TRABAJO_PAGE;

            $OfertasBundle = (object)[];
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

    public function editarPerfilVista()
    {
        $idPerfil = filter_input(INPUT_GET, ConstantesBolsaTrabajo::ID_PERFIL_PERSONA);
        if (v::numeric()->validate($idPerfil)) {
            $this->editarPerfil($idPerfil);
        } else {
            $this->irAlIndex();
        }
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
        $miPerfilDB = $servicios->getMiPerfil($idPerfil);//TODO - enviar la información del perfil 
        /*$miPerfilDB = $this->generarMisOfertas();
        $ofertasVista = (object)[];
        $ofertasVista->misOfertas = $miPerfilDB;*/
        $page = ConstantesPaginas::MI_PERFIL_PAGE;
        TwigViewer::getInstance()->viewPage($page);

    }

    public function editarPerfil($idPerfil)//TODO - Recuperar datos del perfil para poblar la vista de edición
    {
        $servicios = new BolsaTrabajoServicios();

        $miPerfilDB = $servicios->getMiPerfil($idPerfil);
        if (is_array($miPerfilDB)) {

            $perfilBundle = (object)[];

            $perfilBundle->PERFIL_DATA = $miPerfilDB;
            $perfilBundle->FP_ESTUDIOS = $this->cargarCiclosFP();

            $page = ConstantesPaginas::EDITAR_PERFIL_PAGE;


            TwigViewer::getInstance()->viewPage($page, (array)$perfilBundle);

        } else {
            //no existe

        }

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
                echo json_encode(new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::BORRAR_DENEGADA));
            }

        } else {
            echo json_encode(new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::ERROR_FALLO_IDENTIFICADOR_USER));
        }
    }

    private function insertOrUpdatePerfilForm($datos)
    {

        $servicios = new BolsaTrabajoServicios();
        if ($servicios->validarPerfil($datos)) {
            $datos = $servicios->actualizarPerfil($datos);
            if (is_object($datos)) {
                $message = new GenericMessage(MensajesBT::OPERACION_ACEPTADA, MensajesBT::ACTUALIZACION_ACEPTADA);
                $message->setLINK(MensajesBT::INSERCION_ACEPTADA_LINK . $datos->ID_PERFIL);
                echo json_encode($message);
            } else {
                echo json_encode(new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::ERROR_FALLO_INTERNO));
            }
        } else {
            echo json_encode(new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::ERROR_FALLO_IDENTIFICADOR));

        }
    }

    private function insertOrUpdatePerfilFormConfig($datosConfig)
    {
        $servicios = new BolsaTrabajoServicios();

        if ($servicios->validarPerfilConfig($datosConfig)) {
            $servicios->actualizarPerfilConfig($datosConfig);
            //TODO - Construir la respuesta al cliente
        } else {
            echo json_encode(new GenericMessage(MensajesBT::OPERACION_DENEGADA, MensajesBT::ERROR_FALLO_IDENTIFICADOR));
        }
    }

}//fin clase