<?php

/**
 * Description of UsersDAO
 *
 * @author erasto
 */

namespace dao\users;

use dao\DBConnection;
use PDO;

class UsersDAO {
    
    public function getAllUsersDAO() {
        
        try{
            
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();
            
            $sql = "SELECT * FROM USERS";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        } finally {  
            $dbConnection->disconnect();
        }

        return $users;
    }
    
    public function getUserDAO($user){
    
        try{
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare("SELECT * FROM USERS WHERE pass=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $incidencia = $stmt->fetch(PDO::FETCH_OBJ);
            
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        } finally {  
            $dbConnection->disconnect();
        }
        
        return $incidencia;
    }
    
    public function addUserDAO($user)
    {
        try{
            $insertado = true;
            
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();
            $db->beginTransaction();
            
            $stmt = $db->prepare("INSERT INTO USERS (pass,nombre) "
                               . "VALUES (:id,:nombre)");
            $stmt->bindParam(":nombre", $user->nombre);
            $stmt->bindParam(":id", $user->id);
            $stmt->execute();
            $id_usuario->id_usuario = $db->lastInsertId();
            
            
            $stmt2 = $db->prepare("INSERT INTO PERMISOS (id_usuario,id_permiso) "
                               . "VALUES (:id_usuario,:id_permiso)");
            $stmt2->bindParam(":id_usario", $id_usuario->id_usuario);
            $stmt2->bindParam(":id_permiso", $user->id_permiso);
            $stmt2->execute();
            $db->commit();
            
        } catch (\Exception $exception) {
            $insertado = false;
            $db->rollBack();
        } finally {
            $dbConnection->disconnect();
        }
        return $insertado;
    }
    public function updateUserDAO($user)
    {
        $dbConnection = new DBConnection();

        $db = $dbConnection->getConnection();
        $stmt = $db->prepare("SELECT * FROM USERS WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        //$incidencia = $stmt->fetch(PDO::FETCH_OBJ);
        $dbConnection->disconnect();
        //return $incidencia;
    }
    public function deleteUserDAO($user)
    {
        $dbConnection = new DBConnection();

        $db = $dbConnection->getConnection();
        $stmt = $db->prepare("SELECT * FROM USERS WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        //$incidencia = $stmt->fetch(PDO::FETCH_OBJ);
        $dbConnection->disconnect();
        //return $incidencia;
    }
}
