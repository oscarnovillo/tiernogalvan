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
        $db = $dbConnection->getConnection();
        try{                 
            $id = "";
            $sql = categorias\ConstantesCategorias::INSERT_CATEGORY; 
            $db->beginTransaction();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id, $categoria));
            $filas = $stmt->rowCount();
            $last_id = $db->lastInsertId();
            $path= Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$nombre_categoria;
            if (mkdir($path)){
                $db->commit();
            }else{
                $db->rollback();
                return -1;
            }
            return $last_id;
        }catch(\Exception $exception){
            
            
            return -1;
        }finally{
            $dbConnection->disconnect();
        }
        
    }
   
    public function updateCategoriaDAO($categoria,$idcategoria,$old_category){
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $old= Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$old_category;
        $new = Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria;
        try{                      
            $sql = categorias\ConstantesCategorias::UPDATE_CATEGORY;
            $db->beginTransaction();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($categoria,$idcategoria));
            $filas = $stmt->rowCount();
            if (rename($old,$new)){
                $db->commit();
            }else{
                return -1;
            }
                
            return $filas;
        }catch(\Exception $exception){
            $db->rollback();
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