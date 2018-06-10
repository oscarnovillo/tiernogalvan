<?php

namespace dao\categorias;

use dao\DBConnection;
use PDO;
use \utils\categorias;

class CategoriasDAO{

      public function getCategoriaDAO(){
        $dbConnection = new DBConnection();
        try{
            $categorias = (object)[];
            $db = $dbConnection->getConnection();
            $sql = categorias\ConstantesCategorias::GET_CATEGORIES;
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $categorias = $stmt->fetchAll(PDO::FETCH_OBJ);  
        } catch (\Exception $exception) { 
            return -1;
        } finally {  
            $dbConnection->disconnect();
        }
        return $categorias;
    }
    
    public function insertCategoriaDAO($categoria) {
        $dbConnection = new DBConnection();
        try{
            $id = "";
            $sql = categorias\ConstantesCategorias::INSERT_CATEGORY;
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id, $categoria));
            $filas = $stmt->rowCount();
            $last_id = $db->lastInsertId();
            return $last_id;
        }catch(\Exception $exception){
            return -1;
        }finally{
            $dbConnection->disconnect();
        }
        
    }
   
    public function updateCategoriaDAO($categoria){
        $dbConnection = new DBConnection();
        try{
            $sql = categorias\ConstantesCategorias::UPDATE_CATEGORY;
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($categoria));
            $filas = $stmt->rowCount();
            $dbConnection->disconnect();
            return $filas;
        }catch(\Exception $exception){
            return -1;
        }finally{
            $dbConnection->disconnect();
        }
    } 
    
    public function deleteCategoriaDAO($id) {
        $dbConnection = new DBConnection();
        try{
            $sql = categorias\ConstantesCategorias::DELETE_CATEGORY;            
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $filas = $stmt->rowCount();
            $dbConnection->disconnect();
            return $filas;
        }catch(\Exception $exception){
            return -1;
        }finally{
            $dbConnection->disconnect();
        }
    }
}