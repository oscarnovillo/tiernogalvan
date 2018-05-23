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
            
            //$user = new Users();
            $user = new \stdClass;
                    
            $user->id = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_ID);
            $user->nick = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_NICK);
            $user->nombre = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_NAME);
            $user->pass = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_PASS);
            $user->apellidos = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_LASTNAME);
            $user->telefono = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_TEL);
            $user->email = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_EMAIL);
            $user->permiso = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_PERMISSION);
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
                    
                    if($userChecked != null){
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
        
        $users = $usersSevicios->getAllUsers();
        
        if($users != null){
            $parameters['users'] = $users;
        }
        
        TwigViewer::getInstance()->viewPage($page,$parameters);
        
    }
}
