<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VentasDAO
 *
 * @author Miguel
 */

namespace dao\ventaLibros;

use dao\DBConnection;
use PDO;

class VentasDAO {
    
    public function addVenta($venta){
        $db = new DBConnection();
        $conn = $db->getConnection();
        
        $stmt = $conn->prepare("INSERT INTO venta_libros (id_vendedor, email, titulo, isbn, precio, asignatura, curso, fecha_publicacion, estado) VALUES (?,?,?,?,?,?,?,?,'A la venta')");
        
        $stmt->bindParam(1, $venta->id_vendedor);
        $stmt->bindParam(2, $venta->email);
        $stmt->bindParam(3, $venta->titulo);
        $stmt->bindParam(4, $venta->isbn);
        $stmt->bindParam(5, $venta->precio);
        $stmt->bindParam(6, $venta->asignatura);
        $stmt->bindParam(7, $venta->curso);
        $stmt->bindParam(8, $venta->fecha_publicacion);
        
        $insertado = $stmt->execute();
        
        $db->disconnect();
        return $insertado;
    }
    
    public function getAllVentas(){
        $db = new DBConnection();
        $conn = $db->getConnection();
        
        $ventas = $conn->prepare("SELECT * FROM venta_libros WHERE estado != 'Reservado'");
        $ventas->setFetchMode(PDO::FETCH_ASSOC);
        $ventas->execute();
        
        $db->disconnect();
        return $ventas;
    }
    
    public function getMisVentas($id){
        $db = new DBConnection();
        $conn = $db->getConnection();
        
        $stmt = $conn->prepare("SELECT * FROM venta_libros WHERE id_vendedor = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        $mis_ventas = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $db->disconnect();
        return $mis_ventas;
    }
    
    public function resVenta($id){
        $db = new DBConnection();
        $conn = $db->getConnection();
        
        $actualizado;
        
        $stmt = $conn->prepare("UPDATE venta_libros SET estado = 'Reservado' WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        if (($stmt->rowCount()) > 0){
            $actualizado = true;
        }else{
            $actualizado = false;
        }
        
        $db->disconnect();
        return $actualizado;
    }
}
