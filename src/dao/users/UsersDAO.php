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

            $sql = "SELECT u.id, u.nombre, u.apellidos, u.email, u.telefono, u.pass, u.nick, p.id_rol, u.activado "
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

    public function getUserByIdDao($id)
    {

        try {

            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            $sql = "SELECT u.id, u.nombre, u.apellidos, u.email, u.telefono, u.pass, u.nick from users u";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            return $user;

        } catch (\Exception $exception) {

        } finally {
            $dbConnection->disconnect();
        }
        return false;
    }

    public function getUserPermissionsByIdDao($id){
        try {

            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            $sql = "SELECT u.id, u.nombre, u.apellidos, u.email, u.telefono, u.pass, u.nick, p.id_rol, r.descripcion as rank_name "
                . "from users u "
                . "join permisos p on u.id = p.id_usuario "
                . "join roles r on r.id_rol=p.id_rol"
                . " where u.id=" . $id;
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $permissions = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $permissions;

        } catch (\Exception $exception) {

        } finally {
            $dbConnection->disconnect();
        }
        return [];
    }
    
    public function getUserByNickDAO($user){
    
        try{
            
            $incidencia = (object)[];
            
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare("SELECT * FROM users WHERE nick=:nick");
            $stmt->bindParam(":nick", $user->nick);
            $stmt->execute();
            $incidencia = $stmt->fetch(PDO::FETCH_OBJ);
            
        } catch (\Exception $exception) {
          
        } finally {  
            $dbConnection->disconnect();
        }
        
        return $incidencia;
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
            
            $stmt = $db->prepare("INSERT INTO users (nombre,apellidos,telefono,email,pass,nick,activado) "
                               . "VALUES (:nombre,:apellidos,:telefono,:email,:pass,:nick,:activado)");
            $stmt->bindParam(":nombre", $user->nombre);
            $stmt->bindParam(":apellidos", $user->apellidos);
            $stmt->bindParam(":telefono", $user->telefono);
            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":pass", $user->pass);
            $stmt->bindParam(":nick", $user->nick);
            $stmt->bindParam(":activado", $user->activado);
            $stmt->execute();
            $id_usuario = $db->lastInsertId();
            
            $stmt = $db->prepare("INSERT INTO permisos (id_usuario,id_rol) "
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
            $db->beginTransaction();

            $insertado = true;

            $stmt = $db->prepare("UPDATE users "
                    . "SET nombre=:nombre, apellidos=:apellidos, telefono=:telefono, "
                    . "email=:email, pass=:pass, nick=:nick "
                    . "WHERE id=:id ");
            $stmt->bindParam(":id", $user->id);
            $stmt->bindParam(":nombre", $user->nombre);
            $stmt->bindParam(":apellidos", $user->apellidos);
            $stmt->bindParam(":telefono", $user->telefono);
            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":pass", $user->pass);
            $stmt->bindParam(":nick", $user->nick);
            $stmt->execute();
            
            $stmt = $db->prepare("UPDATE permisos "
                    . "SET id_rol=:id_rol "
                    . "WHERE id_usuario=:id ");
            $stmt->bindParam(":id", $user->id);
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
    
    public function deleteUserDAO($user)
    {
        try{
        
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();
            $db->beginTransaction();

            $insertado = true;

            $stmt = $db->prepare("DELETE from users "
                    . "WHERE id=:id ");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            
            $stmt = $db->prepare("DELETE from permisos " 
                    . "WHERE id_usuario=:id ");
            $stmt->bindParam(":id", $user->id);
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
 
    public function activarCuentaDAO($user){
         
        try{
            $incidencia = (object)[];
            
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare("INSERT INTO users (activado) "
                               . "VALUES (:activado) "
                               . "WHERE nick = :nick");
            $stmt->bindParam(":activado", $user->activado);
            $stmt->bindParam(":nick", $user->nick);
            $stmt->execute();
            $incidencia = $stmt->fetch(PDO::FETCH_OBJ);
            
        } catch (\Exception $exception) {
          
        } finally {  
            $dbConnection->disconnect();
        }        
        return $incidencia;
    }
    
    public function getCodActDAO($user){
         
        try{
            $incidencia = (object)[];
            
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare("SELECT codigo_activacion "
                               . "FROM users "
                               . "WHERE nick=:nick");
            $stmt->bindParam(":nick", $user->nick);
            $stmt->execute();
            $incidencia = $stmt->fetch(PDO::FETCH_OBJ);
            
        } catch (\Exception $exception) {
          
        } finally {  
            $dbConnection->disconnect();
        }
        return $incidencia;
    }
    
    public function updatePassDAO($user){
         
        try{
            $incidencia = (object)[];
            
            $dbConnection = new DBConnection();
            $db = $dbConnection->getConnection();

            $stmt = $db->prepare("UPDATE users "
                    . "SET pass=:nuevo_pass "
                    . "WHERE nick=:nick ");
            $stmt->bindParam(":nuevo_pass", $user->pass);
            $stmt->bindParam(":nick", $user->nick);
            $stmt->execute();
            $incidencia = $stmt->fetch(PDO::FETCH_OBJ);
            
        } catch (\Exception $exception) {
          
        } finally {  
            $dbConnection->disconnect();
        }
        return $incidencia;
    }
    
    
}
