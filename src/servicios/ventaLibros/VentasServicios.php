<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author Miguel
 */

namespace servicios\ventaLibros;

use dao\ventaLibros\VentasDAO;

class VentasServicios {
    
    public function addVenta($venta){
        $dao = new VentasDAO();
        return $dao->addVenta($venta);
    }
}
