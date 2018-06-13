<?php

namespace dao\documentos;

use dao\DBConnection;
use PDO;
use \utils\documentos;
use utils\Constantes;
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
            $sql = documentos\ConstantesDocumentos::INSERT_DOCUMENT;
            $db->beginTransaction();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($documento['name'],$idcategoria));
            if(move_uploaded_file($documento['tmp_name'],Constantes::CARPETA_DOCUMENTOS_DIRECCION."/".$categoria ."/". $documento['name'])){
                $db->commit();
            }else{
                $db->rollback();
                return -1;;
            }
            return true;
        } catch (\Exception $exception) {   
            $db->rollback();
            return -1;
        } finally {  
            $dbConnection->disconnect();
        }
        
    }
   
    public function updateDocumentoDAO($id,$documento,$categoria,$old,$idcategoria){
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $new = "";
        $olddoc= Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria.'/'.$old;
        if (strpos($documento, '.') !== false){
            $new = Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria.'/'.$documento;
        }else{
            $pos = strpos($old,".");
            $extension = substr($old,$pos);
            $docExt = $documento.$extension;
            $new = Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria.'/'.$docExt;
        }
        try{
            $sql = documentos\ConstantesDocumentos::UPDATE_DOCUMENT; 
            $db->beginTransaction();
            $stmt = $db->prepare($sql);
            $stmt->execute(array($docExt,$id,$idcategoria));
            
            
            if (rename($olddoc,$new)){
               $db->commit();
            }else{
               $db->rollback();
               return -1;
            }
            return True;
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
            $path= Constantes::CARPETA_DOCUMENTOS_DIRECCION.'/'.$categoria.'/'.$documento;
            if (unlink($path)){
                $db->commit();
                return True;
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
