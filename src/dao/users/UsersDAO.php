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
            
            $users = (object)[];
            
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();
            
            $sql = "SELECT * FROM USERS";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (\Exception $exception) {
            
        } finally {  
            $dbConnection->disconnect();
        }

        return $users;
    }
    
    public function getUserDAO($user){
    
        try{
            
            $incidencia = (object)[];
            
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare("SELECT * FROM users WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $incidencia = $stmt->fetch(PDO::FETCH_OBJ);
            
        } catch (\Exception $exception) {
          
        } finally {  
            $dbConnection->disconnect();
        }
        
        return $incidencia;
    }
    
    public function addUserDAO($user)
    {
        try{
            $id_usuario = new \stdClass;
            $insertado = true;
            
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();
            $db->beginTransaction();
            
            $stmt = $db->prepare("INSERT INTO users (id,nombre,apellidos,telefono,email,pass,nick) "
                               . "VALUES (:id,:nombre,:apellidos,:telefono,:email,:pass,:nick)");
            $stmt->bindParam(":id", $user->id);
            $stmt->bindParam(":nombre", $user->nombre);
            $stmt->bindParam(":apellidos", $user->apellidos);
            $stmt->bindParam(":telefono", $user->telefono);
            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":pass", $user->pass);
            $stmt->bindParam(":nick", $user->nick);
            $stmt->execute();
            $id_usuario->id_usuario = $db->lastInsertId();
            
            $stmt2 = $db->prepare("INSERT INTO permisos (id_usuario,id_rol) "
                               . "VALUES (:id_usuario,:id_rol)");
            $stmt2->bindParam(":id_usario", $id_usuario->id_usuario);
            $stmt2->bindParam(":id_rol", $user->id_rol);
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
