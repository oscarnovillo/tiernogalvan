<?php

namespace dao\documentos;

use dao\DBConnection;
use PDO;
use \utils\documentos;

class DocumentosDAO{
   
    public function getDocumentosDAO(){      
        try{       
            $documentos = (object)[];         
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();           
            $sql = documentos\ConstantesDocumentos::GET_DOCUMENTS;
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $documentos = $stmt->fetchAll(PDO::FETCH_OBJ);       
        } catch (\Exception $exception) {          
        } finally {  
            $dbConnection->disconnect();
        }
        return $documentos;
    }
    
      public function getDocumentoCategoriaDAO($categoria){
        try{
            $documentos_categoria = (object)[];
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();
            $sql = documentos\ConstantesDocumentos::GET_DOCUMENT_CATEGORY;
            $stmt = $db->prepare($sql);
             $stmt->execute(array($categoria));
            $documentos_categoria = $stmt->fetchAll(PDO::FETCH_OBJ);  
        } catch (\Exception $exception) {   
        } finally {  
            $dbConnection->disconnect();
        }
        return $documentos_categoria;
    }
    
    public function insertDocumentoDAO($documento,$ruta,$categoria) {
        $id = "";
        $sql = documentos\ConstantesDocumentos::INSERT_DOCUMENT;
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id,$documento,$ruta,$categoria));
        $filas = $stmt->rowCount();
        $dbConnection->disconnect();
        return $filas;
    }
   
    public function updateDocumentoDAO($id,$documento,$ruta,$categoria){
        $sql = documentos\ConstantesDocumentos::UPDATE_DOCUMENT;
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($documento, $ruta, $categoria,$id));
        $filas = $stmt->rowCount();
        $dbConnection->disconnect();
        return $filas;
    } 
    
    public function deleteDocumentoDAO($id) {
        $sql = documentos\ConstantesDocumentos::DELETE_DOCUMENT;
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $filas = $stmt->rowCount();
        $dbConnection->disconnect();
        return $filas;
    }
}