<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controllers;

use utils\Constantes;

use utils\ConstantesPaginas;
use model\Movimiento;
use servicios\contabilidad\ContabilidadServicios;

use utils\TwigViewer;
/**
 * Description of ContabilidadController
 *
 * @author user
 */
class ContabilidadController {
    //put your code here
    
    public function contabilidad()
    {
        if(isset($_SESSION[Constantes::SESS_USER]->id_rol))
            $id_rol = $_SESSION[Constantes::SESS_USER]->id_rol;
        else
            $id_rol =-1;
        $parameters = array();
        $page = ConstantesPaginas::CONTABILIDAD;
        if ($id_rol == Constantes::ID_ROL_ADMIN || $id_rol == Constantes::ID_ROL_PROFESOR){
            
            $contabilidadServicios = new ContabilidadServicios();
            
            
            $rango = $id_rol == Constantes::ID_ROL_ADMIN ? "ADMIN" : "USER";

            $parameters["permiso"] = $rango;
            $parameters['movimientos'] = $contabilidadServicios->getAllMovimientos();
            
        }
        
        else{
            $parameters['error'] = 'No tienes permiso para realizar esta accion';
        }  
        
        if ($id_rol == Constantes::ID_ROL_ADMIN || $id_rol == Constantes::ID_ROL_PROFESOR){
           
            TwigViewer::getInstance()->viewPage($page, $parameters);
        }else{
            $pagina = ConstantesPaginas::ACCESO_PROHIBIDO;
            TwigViewer::getInstance()->viewPage($pagina, $parameters);
        }
        
    }
}
