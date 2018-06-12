<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controllers;

use model\GenericMessage;
use utils\seguimientoProgramaciones\seguiminetoConstantes;
use Teapot\StatusCode\Http;
use servicios\seguimientoProgramaciones\seguimientoServices;
use utils\Constantes;
use utils\ConstantesPaginas;
use utils\TwigViewer;

/**
 * Description of SeguimientoProgramaciones
 *
 * @author Sergio
 */
class SeguimientoProgramaciones {

    public function seguimientoProgramacionesPrincipal() {
        $parametros = array();
        $id_rol = $_SESSION[Constantes::SESS_USER]->id_rol;
        if ($id_rol == Constantes::ID_ROL_PROFESOR){
            if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION]) && $_REQUEST[seguiminetoConstantes::DESTINO]) {
                $accion = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
                $destino = $_REQUEST[seguiminetoConstantes::DESTINO];
                switch ($accion):
                    case seguiminetoConstantes::ACCION_INSERTAR:
                        switch ($destino):
                            case seguiminetoConstantes::ASIGNATURAS:
                                $mensaje = new \stdClass;
                                $json_asignatura = $_REQUEST[seguiminetoConstantes::OBJETO_ASIGNATURA_JSON];
                                $servicios = new seguimientoServices();
                                $objetoAsig = $servicios->parseo_json($json_asignatura);
                                if ($objetoAsig->nombre != "" && $objetoAsig != "") {
                                    $asignatura_insertada = $servicios->insertar_asignatura($servicios->parseo_json($json_asignatura));
                                    echo $asignatura_insertada;
                                } else {
                                    $mensaje->error = \utils\seguimientoProgramaciones\constantesMensajes::PARAMETROS_NO_RECIBIDOS;
                                    echo json_encode($mensaje);
                                }
                                break;
                            case seguiminetoConstantes::UNIDADES:
                                $json_unidad = $_REQUEST[seguiminetoConstantes::OBJETO_UNIDAD_JSON];
                                $servicios = new seguimientoServices();
                                $objetoUnidad = $servicios->parseo_json($json_unidad);
                                if ($objetoUnidad->nombre != "" && $objetoUnidad->evaluacion != "" && $objetoUnidad->id_asignatura != "") {
                                    $unidad_insertada = $servicios->insertar_unidad_trabajo($servicios->parseo_json($json_unidad));
                                    echo $unidad_insertada;
                                } else {
                                    $mensaje->error = \utils\seguimientoProgramaciones\constantesMensajes::PARAMETROS_NO_RECIBIDOS;
                                    echo json_encode($mensaje);
                                }
                                break;
                        endswitch;
                        break;
                    case seguiminetoConstantes::ACCION_MODIFICAR:
                        switch ($destino):
                            case seguiminetoConstantes::ASIGNATURAS:
                                $mensaje = new \stdClass;
                                $json_asignatura = $_REQUEST[seguiminetoConstantes::OBJETO_ASIGNATURA_JSON];
                                $servicios = new seguimientoServices();
                                $objetoAsig = $servicios->parseo_json($json_asignatura);
                                if ($objetoAsig->id_asignatura != "" && $objetoAsig->nombre != "") {
                                    $asignatura_actualizada = $servicios->modificar_asignatura($servicios->parseo_json($json_asignatura));
                                    echo $asignatura_actualizada;
                                } else {
                                    $mensaje->error = \utils\seguimientoProgramaciones\constantesMensajes::PARAMETROS_NO_RECIBIDOS;
                                    echo json_encode($mensaje);
                                }
                                break;

                            case seguiminetoConstantes::UNIDADES:
                                $mensaje = new \stdClass;
                                $json_unidad = $_REQUEST[seguiminetoConstantes::OBJETO_UNIDAD_JSON];
                                $servicios = new seguimientoServices();
                                $objetoUnidad = $servicios->parseo_json($json_unidad);
                                if ($objetoUnidad->id_asignatura != "" && $objetoUnidad->nombre != "") {
                                    $unidad_actualizada = $servicios->modificar_unidad_trabajo($servicios->parseo_json($json_unidad));
                                    echo $unidad_actualizada;
                                } else {
                                    $mensaje->error = \utils\seguimientoProgramaciones\constantesMensajes::PARAMETROS_NO_RECIBIDOS;
                                    echo json_encode($mensaje);
                                }
                                break;

                        endswitch;
                        break;

                    case seguiminetoConstantes::ACCION_LEER:
                        switch ($destino):
                            case seguiminetoConstantes::ASIGNATURAS:
                                $servicios = new seguimientoServices();
                                $asignaturas = $servicios->leer_asignatura();
                                return $asignaturas;
                                break;

                            case seguiminetoConstantes::UNIDADES:
                                return false;
                                break;

                        endswitch;
                        break;

                    case seguiminetoConstantes::ACCION_BORRAR:
                        switch ($destino):
                            case seguiminetoConstantes::ASIGNATURAS:
                                $mensaje = new \stdClass;
                                $json_asignatura = $_REQUEST[seguiminetoConstantes::OBJETO_ASIGNATURA_JSON];
                                $servicios = new seguimientoServices();
                                $borrar = $servicios->parseo_json($json_asignatura);
                                if ($borrar->id_asignatura != "") {
                                    $asignatura_borrada = $servicios->borrar_asignatura($servicios->parseo_json($json_asignatura));
                                    echo $asignatura_borrada;
                                } else {
                                    $mensaje->error = \utils\seguimientoProgramaciones\constantesMensajes::PARAMETROS_NO_RECIBIDOS;
                                    echo json_encode($mensaje);
                                }
                                break;

                            case seguiminetoConstantes::UNIDADES:
                                $mensaje = new \stdClass;
                                $json_asignatura = $_REQUEST[seguiminetoConstantes::OBJETO_UNIDAD_JSON];
                                $servicios = new seguimientoServices();
                                $borrar = $servicios->parseo_json($json_asignatura);
                                if ($borrar->id_unidad != "") {
                                    $asignatura_borrada = $servicios->borrar_unidad_trabajo($servicios->parseo_json($json_asignatura));
                                    echo $asignatura_borrada;
                                } else {
                                    $mensaje->error = \utils\seguimientoProgramaciones\constantesMensajes::PARAMETROS_NO_RECIBIDOS;
                                    echo json_encode($mensaje);
                                }
                                break;
                                break;

                        endswitch;
                        break;

                    case seguiminetoConstantes::GET_ASIGNATURAS:
                        switch ($destino):
                            case seguiminetoConstantes::ASIGNATURAS:
                                $mensaje = new \stdClass;
                                $asignaturasObjeto = new \stdClass;
                                $idcurso = $_REQUEST[seguiminetoConstantes::ID_CURSO];
                                $servicios = new seguimientoServices();
                                if ($idcurso != "") {
                                    $asignaturasObjeto->asignaturas = $servicios->get_asignaturas_curso($idcurso);
                                    echo json_encode($asignaturasObjeto);
                                } else {
                                    $mensaje->error = \utils\seguimientoProgramaciones\constantesMensajes::PARAMETROS_NO_RECIBIDOS;
                                    echo json_encode($mensaje);
                                }
                                break;
                            case seguiminetoConstantes::GET_CURSOS_ASIGNATURAS:
                                $cursosObjeto = new \stdClass;
                                $id_asignatura = $_REQUEST[seguiminetoConstantes::OBJETO_ASIGNATURA_JSON];
                                if ($id_asignatura != "") {
                                    $servicios = new seguimientoServices();
                                    $cursosObjeto->curso_asignatura = $servicios->get_cursos_asignaturas($servicios->parseo_json($id_asignatura));
                                    $cursosObjeto->cursos = $servicios->leer_cursos();
                                    echo json_encode($cursosObjeto);
                                } else {
                                    $cursosObjeto->error = \utils\seguimientoProgramaciones\constantesMensajes::PARAMETROS_NO_RECIBIDOS;
                                    echo json_encode($cursosObjeto);
                                }
                                break;
                            case seguiminetoConstantes::UNIDADES:
                                $unidadesObjeto = new \stdClass;
                                $id_unidad = $_REQUEST["id_asignatura"];
                                if ($id_unidad != "") {
                                    $servicios = new seguimientoServices();
                                    $unidadesObjeto->unidades = $servicios->get_unidad_asignatura($id_unidad);
                                    echo json_encode($unidadesObjeto);
                                } else {
                                    $unidadesObjeto->error = \utils\seguimientoProgramaciones\constantesMensajes::PARAMETROS_NO_RECIBIDOS;
                                    echo json_encode($unidadesObjeto);;
                                }
                                break;
                        endswitch;
                        break;
                    case seguiminetoConstantes::MODIFICAR_ESTADO_TEMA:
                        $mensaje = new \stdClass;
                        $json_unidad = $_REQUEST[seguiminetoConstantes::OBJETO_UNIDAD_JSON];
                        $servicios = new seguimientoServices();
                        $objetoUnidad = $servicios->parseo_json($json_unidad);
                        if ($objetoUnidad->id != "") {
                            $unidad_actualizada = $servicios->modificar_estado_tema($servicios->parseo_json($json_unidad));
                            echo $unidad_actualizada;
                        } else {
                            $mensaje->error = \utils\seguimientoProgramaciones\constantesMensajes::PARAMETROS_NO_RECIBIDOS;
                            echo json_encode($mensaje);
                        }
                        break;
                    case seguiminetoConstantes::BORRADO_TOTAL_ASIGNATURA:
                        $asignaturaObjeto = new \stdClass;
                        $id_asignatura = $_REQUEST[seguiminetoConstantes::OBJETO_ASIGNATURA_JSON];
                        $servicios = new seguimientoServices();
                        echo $_REQUEST[seguiminetoConstantes::OBJETO_ASIGNATURA_JSON];
                        $id_asignatura_id = $servicios->parseo_json($id_asignatura);
                        if ($id_asignatura_id->id_asignatura != "") {
                            $servicios = new seguimientoServices();
                            $asignaturaObjeto->mensaje = $servicios->borrado_total($id_asignatura);
                            echo $asignaturaObjeto;
                        } else {
                            $asignaturaObjeto->error = \utils\seguimientoProgramaciones\constantesMensajes::PARAMETROS_NO_RECIBIDOS;
                            echo json_encode($asignaturaObjeto);
                        }
                        break;
                endswitch;
            } else {
                $servicios = new seguimientoServices();
                $parametros["cursos"] = $servicios->leer_cursos();
                $parametros["asignaturas"] = $servicios->leer_asignatura();
                /* $unidades_trabajo = $servicios->leer_unidad_trabajo();
                  $$objetoPasar = new \stdClass;
                  $objetoPasar->asingaturas = json_encode($asignaturas);
                  $objetoPasar->unidades = json_encode($unidades_trabajo); */
                $page = ConstantesPaginas::SEGUIMIENTO_PROGRAMACIONES;
                TwigViewer::getInstance()->viewPage($page, (array) $parametros);
            }
        }else{
            $errController->forbiddenAccess();
        }
    }

}
