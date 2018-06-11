<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace controllers;

use utils\Constantes;
use utils\ventaLibros\ConstantesVentas;
use utils\TwigViewer;
use utils\Mailer;
use servicios\ventaLibros\VentasServicios;

/**
 * Description of VentaLibrosController
 *
 * @author Miguel
 */
class VentaLibrosController {
    
    public function ventas(){
        $page = ConstantesVentas::VENTAS_PAGE;
        $parameters = array();
        $ventasSevicios = new VentasServicios();
        $user = $_SESSION[Constantes::SESS_USER];
        
        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            
            switch ($action) {
                case ConstantesVentas::ACCION_ADD_LIBRO:
                    $venta = new \stdClass;
                    
                    $venta->id_vendedor = $user->id;
                    $venta->email = $user->email;
                    $venta->titulo = $_REQUEST[ConstantesVentas::PARAM_TITULO];
                    $venta->isbn = $_REQUEST[ConstantesVentas::PARAM_ISBN];
                    $venta->precio = floatval($_REQUEST[ConstantesVentas::PARAM_PRECIO]);
                    $venta->asignatura = $_REQUEST[ConstantesVentas::PARAM_ASIGNATURA];
                    $venta->curso = $_REQUEST[ConstantesVentas::PARAM_CURSO];
                    $venta->fecha_publicacion = date("Y-m-d");
                    
                    $ventaCreada = $ventasSevicios->addVenta($venta);
                    
                    if($ventaCreada){
                        $parameters['mensaje'] = ConstantesVentas::VENTA_CORRECTA;
                    }else{
                        $parameters['mensaje'] = ConstantesVentas::ERROR;
                    }
                    
                    break;
                    
                case ConstantesVentas::ACCION_RES_LIBRO:
                    $id_venta = $_REQUEST[ConstantesVentas::PARAM_ID_VENTA];
                    $id_vendedor =(int)$_REQUEST[ConstantesVentas::PARAM_ID_VENDEDOR];
                    
                    if($id_vendedor == $user->id){
                        $parameters['mensaje'] = ConstantesVentas::ERROR_MISMO_USER;
                    }else{
                        $actualizado = $ventasSevicios->resVenta($id_venta, $user->id);

                        if($actualizado == true){
                            $mailer = new Mailer();
                            $vendedor = $ventasSevicios->getUser($id_vendedor);
                            $nombre = $vendedor[0]->nombre . " " . $vendedor[0]->apellidos;
                            $titulo = $_REQUEST[ConstantesVentas::PARAM_TITULO];
                            
                            $cuerpoEmail = "<html><body><h2>Alguien ha reservado tu libro.</h2>"
                                    . "<br><span>Tu libro \"" . $titulo . "\"</span>"
                                    . "<br><span>Ponte en contacto a través del siguiente "
                                    . "email: " . $user->email . "</span></body></html>";
                            
                            $mailer->sendMail($vendedor[0]->email, $nombre, ConstantesVentas::EMAIL_SUBJECT, $cuerpoEmail);
                            
                            $parameters['mensaje_reserva'] = ConstantesVentas::VENTA_RESERVADA;
                        }else{
                            $parameters['mensaje'] = ConstantesVentas::ERROR;
                        }
                    }
                    
                    break;
                    
                case ConstantesVentas::ACCION_EDIT_LIBRO:
                    $venta = new \stdClass;
                    
                    $venta->id = $_REQUEST[ConstantesVentas::PARAM_ID_VENTA];
                    $venta->titulo = $_REQUEST[ConstantesVentas::PARAM_TITULO];
                    $venta->isbn = $_REQUEST[ConstantesVentas::PARAM_ISBN];
                    $venta->precio = floatval($_REQUEST[ConstantesVentas::PARAM_PRECIO]);
                    $venta->asignatura = $_REQUEST[ConstantesVentas::PARAM_ASIGNATURA];
                    $venta->curso = $_REQUEST[ConstantesVentas::PARAM_CURSO];
                    $venta->estado = $_REQUEST[ConstantesVentas::PARAM_ESTADO];
                    
                    $ventaEditada = $ventasSevicios->editVenta($venta);
                    
                    if(!$ventaEditada){
                        $parameters['mensaje'] = ConstantesVentas::ERROR_EDITAR;
                    }
                    break;
                
                case ConstantesVentas::ACCION_DEL_LIBRO:
                    $id = $_REQUEST[ConstantesVentas::PARAM_ID_VENTA];
                    
                    $ventaEliminada = $ventasSevicios->delVenta($id);
                    
                    if(!$ventaEliminada){
                        $parameters['mensaje'] = ConstantesVentas::ERROR_BORRAR;
                    }
                    break;
                
            }
        }
        
        if(isset($_REQUEST[ConstantesVentas::PARAM_FILTRO_ASIG])){
            $filt_asig = $_REQUEST[ConstantesVentas::PARAM_FILTRO_ASIG];
        }else{
            $filt_asig = "cualquiera";
        }
        
        if(isset($_REQUEST[ConstantesVentas::PARAM_FILTRO_CURSO])){
            $filt_curso = $_REQUEST[ConstantesVentas::PARAM_FILTRO_CURSO];
        }else{
            $filt_curso = "cualquiera";
        }
        
        if(isset($_REQUEST[ConstantesVentas::PARAM_ORDEN])){
            $orden = $_REQUEST[ConstantesVentas::PARAM_ORDEN];
        }else{
            $orden = "fecha_publicacion";
        }
        $parameters['asig'] = $filt_asig;
        $parameters['curso'] = $filt_curso;
        $parameters['orden'] = $orden;
        
        if(isset($_REQUEST[ConstantesVentas::PARAM_PAGINA])){
            $numPag = $_REQUEST[ConstantesVentas::PARAM_PAGINA];
        }else{
            $numPag = "1";
        }
        
        $numVentas = count($ventasSevicios->getNumVentas($filt_asig, $filt_curso));
        
        $allVentas = $ventasSevicios->getAllVentas($filt_asig, $filt_curso, $orden, $numPag);
        if($allVentas != null){
            $parameters['allVentas'] = $allVentas;
        }
        
        $parameters['numVentas'] = $numVentas;
        $parameters['pageActu'] = $numPag;
        
        $misVentas = $ventasSevicios->getMisVentas($user->id);
        if($misVentas != null){
            $parameters['misVentas'] = $misVentas;
        }
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }
}
