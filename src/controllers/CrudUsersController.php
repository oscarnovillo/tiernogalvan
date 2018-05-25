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
        
        $action = filter_input(INPUT_POST, Constantes::PARAMETER_NAME_ACTION);
        
        if (isset($action)) {
            
            $user = new \stdClass;
                   
            $user->nombre = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_NAME);
            $user->apellidos = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_LASTNAME);
            $user->telefono = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_TEL);
            $user->email = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_EMAIL);
            $user->pass = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_PASS);
            $user->nick = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_NICK);
            $user->id_rol = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_PERMISSION);
            
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
        }
        $usuarios = $usersSevicios->getAllUsers();
            
            if($usuarios != null){
               $parameters['usuarios'] = $usuarios;
            }
            
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }
}
