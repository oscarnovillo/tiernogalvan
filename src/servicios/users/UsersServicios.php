<?php


namespace servicios\users;

use dao\users\UsersDAO;

class UsersServicios {
    
    public function getUser($user){
        $dao = new UsersDAO();
        return $dao->getUserDAO($user);
    }
    public function addUser($user){
        $dao = new UsersDAO();
        return $dao->addUserDAO($user);
    }
    public function updateUser($user){
        $dao = new UsersDAO();
        return $dao->updateUserDAO($user);
    }
    public function deleteUser($user){
        $dao = new UsersDAO();
        return $dao->deleteUserDAO($user);
    }
    public function getAllUsers(){
        $dao = new UsersDAO();
        return $dao->getAllUsersDAO();
    }
    public function getAllPermisos(){
        $dao = new UsersDAO();
        return $dao->getAllPermisosDAO();
    }
    public function getUserByNick($user){
        $dao = new UsersDAO();
        return $dao->getUserByNickDAO($user);
    }
    
    public function activarCuenta($user){
        $dao = new UsersDAO();
        return $dao->activarCuentaDAO($user);
    }
    
    public function getCodAct($user){
        $dao = new UsersDAO();
        return $dao->getCodActDAO($user);
    }
    
    public function updatePass($user){
        $dao = new UsersDAO();
        return $dao->updatePassDAO($user);
    }
    
    function random_code($limit){
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}
