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
                    
                $_SESSION["nombre_user"] = "1";//pones lo que quieras
                $_SESSION["permiso"] = "1";
                    
                    break;
                
                case ConstantesCrudUsers::REGISTER_USER:
                    
                    break;
            }
        }
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }
}
