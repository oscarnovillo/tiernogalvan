<?php


namespace servicios\users;

use dao\users\UsersDAO;
use Respect\Validation\Validator as v;
use utils\bolsaTrabajo\BuzonCorreo;
use utils\bolsaTrabajo\ConstantesBD;

use utils\bolsaTrabajo\GenEmail;

use utils\Constantes;
use utils\loginUsers\ConstantesLoginUsers;
use utils\ConstantesPaginas;



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
    
    public function getAllRoles(){
        $dao = new UsersDAO();
        return $dao->getAllRolesDAO();
    }
    
    public function getUserByNick($user){
        $dao = new UsersDAO();
        return $dao->getUserByNickDAO($user);
    }
    
    public function getUserByPass($pass){
        $dao = new UsersDAO();
        return $dao->getUserByPassDAO($pass);
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
    
    public function updateFechaUser($date){
        $dao = new UsersDAO();
        return $dao->updateFechaUserDAO($date);
    }
    
    public function getPermisoUser($user){
        $dao = new UsersDAO();
        return $dao->getPermisoUserDao($user);
    }
    
    function random_code($limit){
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
    
    public function validarAccion($accion){
        $validador = v::attribute(ConstantesBD::NOMBRE, v::stringType()->length(1, 100));   
        
        return $validador->validate($accion);
    }
    
    public function validarUser($user){
        $validador = v::attribute(ConstantesLoginUsers::PARAM_PASS, v::stringType()->length(1, 100))
            ->attribute(ConstantesLoginUsers::PARAM_NICK, v::stringType()->length(1, 100))
            ->attribute(ConstantesLoginUsers::PARAM_NOMBRE, v::stringType()->length(1, 100))
            ->attribute(ConstantesLoginUsers::PARAM_APELLIDOS, v::stringType()->length(1, 100))
            ->attribute(ConstantesLoginUsers::PARAM_TELEFONO,v::optional(v::numeric()->length(4, 15)))
            ->attribute(ConstantesLoginUsers::PARAM_EMAIL, v::email()->length(4, 80));
            //->attribute(ConstantesLoginUsers::PARAM_PALABRA_CLAVE, v::stringType()->length(1, 100));

        return $validador->validate($user);
    }
    
     public function validarLogin($user){
        $validador = v::attribute(ConstantesLoginUsers::PARAM_PASS, v::stringType()->length(1, 100))
            ->attribute(ConstantesLoginUsers::PARAM_NICK, v::stringType()->length(1, 100));

        return $validador->validate($user);
    }
    
     public function validarRecuperarPass($user){
        $validador = v::attribute(ConstantesLoginUsers::PARAM_NICK, v::stringType()->length(1, 100))
            ->attribute(ConstantesLoginUsers::PARAM_EMAIL, v::email()->length(4, 80));

        return $validador->validate($user);
    }
    
    public function validarCambiarPass($user){
        $validador = v::attribute(ConstantesLoginUsers::PARAM_PASS, v::stringType()->length(1, 100))
            ->attribute(ConstantesLoginUsers::PARAM_NICK, v::stringType()->length(1, 100))
            ->attribute(ConstantesLoginUsers::NUEVO_PASS, v::stringType()->length(1, 100));

        return $validador->validate($user);
    }
    
    
    
}