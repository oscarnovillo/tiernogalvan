<?php

namespace dao\categorias;

use dao\DBConnection;
use PDO;
use \utils\categorias;

class CategoriasDAO{

      public function getCategoriaDAO(){
        try{
            $categorias = (object)[];
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();
            $sql = documentos\ConstantesCategorias::GET_CATEGORIES;
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $categorias = $stmt->fetchAll(PDO::FETCH_OBJ);  
        } catch (\Exception $exception) {   
        } finally {  
            $dbConnection->disconnect();
        }
        return $categorias;
    }
    
    public function insertCategoriaDAO($categoria) {
        $id = "";
        $sql = documentos\ConstantesCategorias::INSERT_CATEGORY;
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id, $categoria));
        $filas = $stmt->rowCount();
        $dbConnection->disconnect();
        return $filas;
    }
   
    public function updateCategoriaDAO($id,$categoria){
        $sql = documentos\ConstantesCategorias::UPDATE_CATEGORY;
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($categoria,$id));
        $filas = $stmt->rowCount();
        $dbConnection->disconnect();
        return $filas;
    } 
    
    public function deleteCategoriaDAO($id) {
        $sql = documentos\ConstantesCategorias::DELETE_CATEGORY;
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $filas = $stmt->rowCount();
        $dbConnection->disconnect();
        return $filas;
    }
}