<?php

namespace controllers;

use utils\crudUsers\ConstantesCrudUsers;
use utils\Constantes;
use utils\ConstantesPaginas;
use utils\TwigViewer;
use model\Users;
use servicios\users\UsersServicios;

/**
 * Description of CrudUsersController
 *
 * @author Erasto
 */

class CrudUsersController {
    
    public function crud(){
        
        $page = ConstantesCrudUsers::CRUD_PAGE;
        $usersSevicios = new UsersServicios();
        $parameters = array();
        
        $action = filter_input(INPUT_GET, Constantes::PARAMETER_NAME_ACTION);
        
        if (isset($action)) {
            
            $user = new Users();
                    
            $user->pass = $_REQUEST[ConstantesVentas::PARAM_PASS];
            $user->nombre = $_REQUEST[ConstantesVentas::PARAM_NICK];
            //etc etc
            
            switch ($action) {
                case ConstantesCrudUsers::INSERT_USER:
                    $userChecked = $usersSevicios->getUser($user);
                    
                    if(!$userChecked){
                        $userChecked = $usersSevicios->addUser($user);
                        
                        if($userChecked){
                            $parameters['mensaje'] = ConstantesCrudUsers::INSERT_YES;
                        }else{
                            $parameters['mensaje'] = ConstantesCrudUsers::INSERT_ERROR;
                        }
                    }else{
                        $parameters['mensaje'] = ConstantesCrudUsers::INSERT_NO;
                    }
                    break;
                
                case ConstantesCrudUsers::UPDATE_USER:
                    $userChecked = $usersSevicios->getUser($user);
                    
                    if($userChecked){
                        $userChecked = $usersSevicios->updateUser($user);
                        
                        if($userChecked){
                            $parameters['mensaje'] = ConstantesCrudUsers::UPDATE_YES;
                        }else{
                            $parameters['mensaje'] = ConstantesCrudUsers::UPDATE_ERROR;
                        }
                    }else{
                        $parameters['mensaje'] = ConstantesCrudUsers::UPDATE_NO;
                    }
                    break;
                   
                case ConstantesCrudUsers::DELETE_USER:
                    $userChecked = $usersSevicios->getUser($user);
                    
                    if(!$userChecked){
                        $userChecked = $usersSevicios->deleteUser($user);
                        
                        if($userChecked){
                            $parameters['mensaje'] = ConstantesCrudUsers::DELETE_YES;
                        }else{
                            $parameters['mensaje'] = ConstantesCrudUsers::DELETE_ERROR;
                        }
                    }else{
                        $parameters['mensaje'] = ConstantesCrudUsers::DELETE_NO;
                    }
                    break;

            }
        }else{
            TwigViewer::getInstance()->viewPage($page,$parameters);
        }
    }
}
