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
    public function seguimientoProgramacionesPrincipal(){
        
        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION]) && $_REQUEST[seguiminetoConstantes::DESTINO]){
            $accion = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            $destino = $_REQUEST[seguiminetoConstantes::DESTINO];
            switch($accion):
                case seguiminetoConstantes::ACCION_INSERTAR:
                    switch($destino):
                        case seguiminetoConstantes::ASIGNATURAS:
                            $json_asignatura = $_REQUEST[seguiminetoConstantes::OBJETO_ASIGNATURA_JSON];
                            $servicios = new seguimientoServices();
                            $asignatura_insertada = $servicios->insertar_asignatura($servicios->parseo_json($json_asignatura));
                            echo $asignatura_insertada;
                        case seguiminetoConstantes::UNIDADES:
                            return false;
                    endswitch;

                case seguiminetoConstantes::ACCION_MODIFICAR:
                    switch($destino):
                        case seguiminetoConstantes::ASIGNATURAS:
                            $json_asignatura = $_REQUEST[seguiminetoConstantes::OBJETO_ASIGNATURA_JSON];
                            $servicios = new seguimientoServices();
                            $asignatura_actualizada = $servicios->modificar_asignatura($servicios->parseo_json($json_asignatura));
                            return $asignatura_actualizada;
                        case seguiminetoConstantes::UNIDADES:
                            return false;
                    endswitch;

                case seguiminetoConstantes::ACCION_LEER:
                    switch($destino):
                        case seguiminetoConstantes::ASIGNATURAS:
                            $servicios = new seguimientoServices();
                            $asignaturas = $servicios->leer_asignatura();
                            return $asignaturas;
                        case seguiminetoConstantes::UNIDADES:
                            return false;
                    endswitch;

                case seguiminetoConstantes::ACCION_BORRAR:
                    switch($destino):
                        case seguiminetoConstantes::ASIGNATURAS:
                            $json_asignatura = $_REQUEST[seguiminetoConstantes::OBJETO_ASIGNATURA_JSON];
                            $servicios = new seguimientoServices();
                            $asignatura_borrada = $servicios->borrar_asignatura($servicios->parseo_json($json_asignatura));
                            return $asignatura_borrada;
                        case seguiminetoConstantes::UNIDADES:
                            return false;
                    endswitch;
            endswitch;
        }else{
            /*$servicios = new seguimientoServices();
            $asignaturas = $servicios->leer_asignatura();
            $unidades_trabajo = $servicios->leer_unidad_trabajo();
            $$objetoPasar = new \stdClass;
            $objetoPasar->asingaturas = json_encode($asignaturas);
            $objetoPasar->unidades = json_encode($unidades_trabajo);*/
            $page = ConstantesPaginas::SEGUIMIENTO_PROGRAMACIONES;
            TwigViewer::getInstance()->viewPage($page);
        }
    }
}
