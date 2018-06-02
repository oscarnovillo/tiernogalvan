<?php

namespace controllers;

use utils\loginUsers\ConstantesLoginUsers;
use utils\Constantes;
use utils\ConstantesPaginas;
use utils\TwigViewer;
use utils\PasswordStorage;
use servicios\users\UsersServicios;

/**
 * Description of LoginUsers
 *
 * @author Erasto
 */

class LoginUsers {
    
    public function login(){
        
        $page = ConstantesLoginUsers::START_PAGE;
        $usersSevicios = new UsersServicios();
        $parameters = array();
        
        $action = filter_input(INPUT_POST, Constantes::PARAMETER_NAME_ACTION);
        
        if (isset($action)) {
            
            $PasswordStorage = new PasswordStorage();
            $user = new \stdClass;
            
            switch ($action) {
                case ConstantesLoginUsers::LOGIN_USER:
                    
                    $user->pass = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_PASS);
                    $user->nick = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_NICK);
                    
                    $userChecked = $usersSevicios->getUserByNick($user);
                     
                    if($userChecked){
                        $pass = $user->pass;
                        $hash = $PasswordStorage->create_hash($pass);

                        if($PasswordStorage->verify_password($pass, $hash)){
                            $parameters['mensaje'] = $userChecked->nombre;
                            $_SESSION[Constantes::SESS_USER] = $userChecked;
                            $page = ConstantesLoginUsers::LOGIN_PAGE;
                        }else{
                            $parameters['mensaje'] = ConstantesLoginUsers::PASS_NO;
                        }  
                    }else{
                        $parameters['mensaje'] = ConstantesLoginUsers::LOGIN_ERROR;
                    }
                    break;
                
                case ConstantesLoginUsers::REGISTER_USER:
                    
                    $page = ConstantesLoginUsers::REGISTRO_PAGE;
                    
                    break;
            }
        }
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }
}
