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
}
