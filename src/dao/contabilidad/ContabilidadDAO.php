<?php
namespace dao\contabilidad;

use dao\DBConnection;
use PDO;

use utils\Constantes;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContabilidadDAO
 *
 * @author user
 */
class ContabilidadDAO {
    //put your code here
    
    
    public function getAllMovimientos(){
        $dbConnection = new DBConnection();
        try{
            $movimientos = (object)[];
            $db = $dbConnection->getConnection();
            $sql = "SELECT mo_id id,mo_fecha fecha, mo_concep concepto,mo_import importe,mo_nummov numero_movimiento,d.de_descri_es departamento FROM movimientos INNER JOIN departamentos_contabilidad d ON movimientos.mo_coddep = d.de_codigo";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $movimientos = $stmt->fetchAll(PDO::FETCH_OBJ);  
        } catch (\Exception $exception) { 
            return -1;
        } finally {  
            $dbConnection->disconnect();
        }
        return $movimientos;
    }
}
