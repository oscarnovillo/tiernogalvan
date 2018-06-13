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
    
    public function getAllVentas($filt_asig, $filt_curso, $orden, $numPag){
        $dao = new VentasDAO();
        return $dao->getAllVentas($filt_asig, $filt_curso, $orden, $numPag);
    }
    
    public function getMisVentas($id){
        $dao = new VentasDAO();
        return $dao->getMisVentas($id);
    }
    
    public function resVenta($id_venta, $id_usuario){
        $dao = new VentasDAO();
        return $dao->resVenta($id_venta, $id_usuario);
    }
    
    public function editVenta($venta){
        $dao = new VentasDAO();
        return $dao->editVenta($venta);
    }
    
    public function completarVenta($venta, $vendedor, $comprador){
        $dao = new VentasDAO();
        return $dao->completarVenta($venta, $vendedor, $comprador);
    }
    
    public function getVentaById($id){
        $dao = new VentasDAO();
        return $dao->getVentaById($id);
    }
    
    public function delVenta($id){
        $dao = new VentasDAO();
        return $dao->delVenta($id);
    }
    
    public function getUser($id){
        $dao = new VentasDAO();
        return $dao->getUser($id);
    }
    
    public function getNumVentas($filt_asig, $filt_curso){
        $dao = new VentasDAO();
        return $dao->getNumVentas($filt_asig, $filt_curso);
    }
}
