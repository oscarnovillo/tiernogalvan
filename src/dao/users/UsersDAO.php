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
    
    public function getAllPermisosDAO() {
        
        try{
            
            $users = (object)[];
            
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();
            
            $sql = "SELECT * FROM permisos";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (\Exception $exception) {
            
        } finally {  
            $dbConnection->disconnect();
        }

        return $users;
    }
    
    public function getAllUsersDAO() {
        
        try{
            
            $users = (object)[];
            
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();
            
            $sql = "SELECT u.id, u.nombre, u.apellidos, u.email, u.telefono, u.pass, u.nick, p.id_rol "
                    . "from users u join permisos p "
                    . "on u.id = p.id_usuario ";
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
            $stmt->bindParam(":id", $user->id);
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
            
            $telefono = intval($user->telefono);
            
            $stmt = $db->prepare("INSERT INTO users (nombre,apellidos,telefono,email,pass,nick)"
                               . "VALUES (:nombre,:apellidos,:telefono,:email,:pass,:nick)");
            $stmt->bindParam(":nombre", $user->nombre);
            $stmt->bindParam(":apellidos", $user->apellidos);
            $stmt->bindParam(":telefono", $telefono);
            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":pass", $user->pass);
            $stmt->bindParam(":nick", $user->nick);
            $stmt->execute();
            $id_usuario = $db->lastInsertId();
            
            $stmt = $db->prepare("INSERT INTO permisos (id_usuario,id_rol)"
                               . "VALUES (:id_usuario,:id_rol)");
            $stmt->bindParam(":id_usuario", $id_usuario);
            $stmt->bindParam(":id_rol", $user->id_rol);
            $stmt->execute();
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
        try{
        
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            $insertado = true;
            $telefono = intval($user->telefono);
            $id = intval($user->id);

            $stmt = $db->prepare("UPDATE users "
                    . "SET  nombre=:nombre, apellidos=:apellidos, telefono=:telefono,"
                    . "email=:email, pass=:pass, nick=:nick"
                    . "WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":nombre", $user->nombre);
            $stmt->bindParam(":apellidos", $user->apellidos);
            $stmt->bindParam(":telefono", $telefono);
            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":pass", $user->pass);
            $stmt->bindParam(":nick", $user->nick);
            $stmt->execute();
            
            } catch (\Exception $exception) {
            $insertado = false;
            } finally {
                $dbConnection->disconnect();
            }
            return $insertado;   
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
