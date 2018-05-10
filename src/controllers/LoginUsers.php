<?php

namespace controllers;

use utils\loginUsers\ConstantesLoginUsers;
use utils\Constantes;
use utils\ConstantesPaginas;
use utils\TwigViewer;


/**
 * Description of LoginUsers
 *
 * @author Erasto
 */

class LoginUsers {
    
    public function login(){
        
        $page = ConstantesLoginUsers::LOGIN_PAGE;
        $usersSevicios = new UsersServicios();
        $parameters = array();
        
        $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
        
        if (isset($action)) {
            switch ($action) {
                case ConstantesCrudUsers::LOGIN_USER:

                    $user = new $user();
                    
                    $user->pass = $_REQUEST[ConstantesVentas::PARAM_PASS];
                    $user->nick = $_REQUEST[ConstantesVentas::PARAM_NICK];
                    
                    break;
                
                case ConstantesCrudUsers::REGISTER_USER:
                    
                    break;
            }
        }
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }
}
