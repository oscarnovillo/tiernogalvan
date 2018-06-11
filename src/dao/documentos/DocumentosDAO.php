<?php

namespace dao\documentos;

use dao\DBConnection;
use PDO;
use \utils\documentos;

class DocumentosDAO{
   
    public function getDocumentosDAO(){         
        $dbConnection = new DBConnection();      
        try{       
            $documentos = (object)[];
            $db = $dbConnection->getConnection();           
            $sql = documentos\ConstantesDocumentos::GET_DOCUMENTS;
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $documentos = $stmt->fetchAll(PDO::FETCH_OBJ); 
            return $documentos;
        } catch (\Exception $exception) {   
            return -1;
        } finally {  
            $dbConnection->disconnect();
        }

    }
    
      public function getDocumentoCategoriaDAO($categoria){
        $dbConnection = new DBConnection();
        try{
            $documentos_categoria = (object)[];
            $db = $dbConnection->getConnection();
            $sql = documentos\ConstantesDocumentos::GET_DOCUMENT_CATEGORY;
            $stmt = $db->prepare($sql);
            $stmt->execute(array($categoria));
            $documentos_categoria = $stmt->fetchAll(PDO::FETCH_OBJ);  
            return $documentos_categoria; 
        } catch (\Exception $exception) {   
            return -1;
        } finally {  
            $dbConnection->disconnect();
        }
       
    }
    
    public function insertDocumentoDAO($documento,$idcategoria,$categoria) {
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        try{
            $id = "";
            $sql = documentos\ConstantesDocumentos::INSERT_DOCUMENT;
            $db->beginTransaction();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id,$documento['name'],$idcategoria));
            $filas = $stmt->rowCount();
            $dbConnection->disconnect();
            $last_id = $db->lastInsertId();
            if(move_uploaded_file($documento['name'],Constantes::CARPETA_DOCUMENTOS_DIRECCION."/".$categoria ."/". $_FILES['archivo']['name'])){
                $db->commit();
            }else{
                $db->rollback();
                return -1;;
            }
            return $last_id;
        } catch (\Exception $exception) {   
            $db->rollback();
            return -1;
        } finally {  
            $dbConnection->disconnect();
        }
        
    }
   
    public function updateDocumentoDAO($id,$documento,$categoria,$old){
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        try{
            $sql = documentos\ConstantesDocumentos::UPDATE_DOCUMENT; 
            $db->beginTransaction();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($documento,$id));
            $filas = $stmt->rowCount();
            $old= Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria.'/'.$old;
            $new = Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria.'/'.$documento;
            if (rename($old,$new)){
               $db->commit();
            }else{
               $db->rollback();
               return -1;
            }
            return $filas;
        } catch (\Exception $exception) {   
            return -1;
        } finally {  
            $dbConnection->disconnect();
        }
        
    } 
    
    public function deleteDocumentoDAO($id,$categoria,$documento) {
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        try{
            $sql = documentos\ConstantesDocumentos::DELETE_DOCUMENT;
            $db->beginTransaction();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $filas = $stmt->rowCount();
            $path= Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria.'/'.$documento;
            if (unlink($path)){
                $db->commit();
                return $filas;
            }else{
                $db->rollback();
                return -1;
            }
        } catch (\Exception $exception) { 
            $db->rollback();
            return -1;
        } finally {  
            $dbConnection->disconnect();
        }
        
    }
}