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
    
    public function insertDocumentoDAO($documento,$categoria) {
        $dbConnection = new DBConnection();
        try{
            $id = "";
            $sql = documentos\ConstantesDocumentos::INSERT_DOCUMENT;
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id,$documento,$categoria));
            $filas = $stmt->rowCount();
            $dbConnection->disconnect();
            $last_id = $db->lastInsertId();
            return $last_id;
        } catch (\Exception $exception) {   
            return -1;
        } finally {  
            $dbConnection->disconnect();
        }
        
    }
   
    public function updateDocumentoDAO($id,$documento,$categoria){
        $dbConnection = new DBConnection();
        try{
            $sql = documentos\ConstantesDocumentos::UPDATE_DOCUMENT;
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($documento, $categoria,$id));
            $filas = $stmt->rowCount();
            $dbConnection->disconnect();
            return $filas;
        } catch (\Exception $exception) {   
            return -1;
        } finally {  
            $dbConnection->disconnect();
        }
        
    } 
    
    public function deleteDocumentoDAO($id) {
        $dbConnection = new DBConnection();
        try{
            $sql = documentos\ConstantesDocumentos::DELETE_DOCUMENT;
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($id));
            $filas = $stmt->rowCount();
            $dbConnection->disconnect();
            return $filas;
        } catch (\Exception $exception) {   
            return -1;
        } finally {  
            $dbConnection->disconnect();
        }
        
    }
}