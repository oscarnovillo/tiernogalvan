<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace servicios\contabilidad;

use dao\contabilidad\ContabilidadDAO;
/**
 * Description of ContabilidadServicios
 *
 * @author user
 */
class ContabilidadServicios {
    
    public function getAllMovimientos(){
        $dao = new ContabilidadDAO();
        return $dao->getAllMovimientos();
    }
}
