<?php

/**
 * Description of UsersServicios
 *
 * @author erasto
 */

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
}
