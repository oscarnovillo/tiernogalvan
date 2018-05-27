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
        
        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            
            switch ($action) {
                case ConstantesVentas::ACCION_ADD_LIBRO:
                    $venta = new \stdClass;
                    
                    //$venta->id_vendedor = $_SESSION["id_usuario"];
                    //$venta->email = $_SESSION["email"];
                    $venta->id_vendedor = 1;
                    $venta->email = "migueldiaz.tg@gmail.com";
                    $venta->titulo = $_REQUEST[ConstantesVentas::PARAM_TITULO];
                    $venta->isbn = $_REQUEST[ConstantesVentas::PARAM_ISBN];
                    $venta->precio = floatval($_REQUEST[ConstantesVentas::PARAM_PRECIO]);
                    $venta->asignatura = $_REQUEST[ConstantesVentas::PARAM_ASIGNATURA];
                    $venta->curso = $_REQUEST[ConstantesVentas::PARAM_CURSO];
                    $venta->fecha_publicacion = date("Y-m-d");
                    
                    $ventaCreada = $ventasSevicios->addVenta($venta);
                    
                    if($ventaCreada){
                        $parameters['mensaje_publicacion'] = ConstantesVentas::VENTA_CORRECTA;
                    }else{
                        $parameters['mensaje_publicacion'] = ConstantesVentas::ERROR;
                    }
                    
                    break;
                    
                case ConstantesVentas::ACCION_RES_LIBRO:
                    $id_venta = $_REQUEST[ConstantesVentas::PARAM_ID_VENTA];
                    $id_vendedor =(int)$_REQUEST[ConstantesVentas::PARAM_ID_VENDEDOR];
                    
                    //$id_usuario = $_SESSION["id_vendedor"];
                    $id_usuario = 1;
                    
                    if($id_vendedor == $id_usuario){
                        $parameters['error_reserva'] = ConstantesVentas::ERROR_MISMO_USER;
                    }else{
                        $actualizado = $ventasSevicios->resVenta($id_venta);

                        if($actualizado == true){
                            /*Enviar email
                            email = $_SESSION["email"];
                            enviar(email); 
                            o como sea xD   
                            */
                            $parameters['mensaje_reserva'] = ConstantesVentas::VENTA_RESERVADA;
                        }else{
                            $parameters['mensaje_reserva'] = ConstantesVentas::ERROR;
                        }
                    }
                    
                    break;
                    
                case ConstantesVentas::ACCION_EDIT_LIBRO:
                    
                    break;
                
                case ConstantesVentas::ACCION_DEL_LIBRO:
                    
                    break;
                
            }
        }
        $allVentas = $ventasSevicios->getAllVentas();
        if($allVentas != null){
            $parameters['allVentas'] = $allVentas;
        }
        
        $misVentas = $ventasSevicios->getMisVentas(1);
        if($misVentas != null){
            $parameters['misVentas'] = $misVentas;
        }
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }
}
