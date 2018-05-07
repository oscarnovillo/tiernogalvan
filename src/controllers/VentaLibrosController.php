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
                    
                    //$venta->id_vendedor = $_SESSION["id_vendedor"];
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
                        $parameters['mensaje'] = ConstantesVentas::VENTA_CORRECTA;
                    }else{
                        $parameters['mensaje'] = ConstantesVentas::ERROR;
                    }
                    
                    break;
            }
        }
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }
}
