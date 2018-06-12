<?php

namespace dao\categorias;

use dao\DBConnection;
use PDO;
use \utils\categorias;
use \utils\documentos;
use utils\Constantes;

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
            $stmt->execute(array( $categoria));
            $path= Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria;
            
            if (mkdir($path, 0777, true)){
                chmod($path,0777);
                $db->commit();
            }else{
                $db->rollback();
                return -1;
            }
            return True;
        }catch(\Exception $exception){
            $db->rollback();
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
    
    public function deleteCategoriaDAO($id,$categoria) {
        $dbConnection = new DBConnection();
         $db = $dbConnection->getConnection();
        try{
            $path= Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria;
            $sql = categorias\ConstantesCategorias::DELETE_CATEGORY;      
            $sql2 = documentos\ConstantesDocumentos::BORRAR_DOCUMENTO_CATEGORIA;
            $db->beginTransaction();
            $stmt = $db->prepare($sql);
            $stmt2 = $db->prepare($sql2);
            $stmt2->execute(array($id));
            $stmt->execute(array($id));
            if(chmod($path,0777)){
                $objects = scandir($path); 
                foreach ($objects as $object) { 
                    if ($object != "." && $object != "..") { 
                      if (is_dir($path."/".$object))
                        rmdir($path."/".$object);
                      else
                        unlink($path."/".$object); 
                    } 
                }
                if (rmdir($path)){
                    $db->commit();
                    return True;
                }else{
                    $db->rollback();
                    return -1;
                }
            }else{
                 $db->rollback();
                    return -1;
            }
        }catch(\Exception $exception){
            $db->rollback();
            return -1;
        }finally{
            $dbConnection->disconnect();
        }
    }
    
    
}