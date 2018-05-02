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

/**
 * Description of VentaLibrosController
 *
 * @author Miguel
 */
class VentaLibrosController {
    
    public function ventas(){
        $page = ConstantesVentas::VENTAS_PAGE;
        $parameters = array();
        
        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            
            switch ($action) {
                case "prueba":
                    $parameters['prueba3'] = "prueba 1 :D";
                    $parameters['prueba2'] = "prueba 2 xD";
                    break;
            }
        }
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }
}
