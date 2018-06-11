<?php

namespace controllers;

use utils\crudUsers\ConstantesCrudUsers;
use utils\Constantes;
use utils\ConstantesPaginas;
use utils\TwigViewer;
use model\Users;
use servicios\users\UsersServicios;
use utils\PasswordStorage;
use servicios\session\SessionServicios;

use Respect\Validation\Validator as v;

/**
 * Description of CrudUsersController
 *
 * @author Erasto
 */

class CrudUsersController {
    
    public function crud(){
     
        $session = new SessionServicios();
 
        if (isset($_SESSION[Constantes::SESS_USER]->id_rol) && $_SESSION[Constantes::SESS_USER]->id_rol == Constantes::ID_ROL_ADMIN) {
          
            $page = ConstantesCrudUsers::CRUD_PAGE;
            $usersSevicios = new UsersServicios();
            $parameters = array();
       
        $action = filter_input(INPUT_POST, Constantes::PARAMETER_NAME_ACTION);
        
        if (isset($action)) {
            
            $user = new \stdClass;
            $PasswordStorage = new PasswordStorage();
            
            $user->id = intval (filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_ID));
            $user->nombre = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_NAME);
            $user->apellidos = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_LASTNAME);
            $user->telefono = intval (filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_TEL));
            $user->email = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_EMAIL);
            $user->nick = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_NICK);
            $user->id_rol = intval (filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_PERMISSION));
            $user->activado = ConstantesCrudUsers::PARAM_ACTIVADO;
            $user->pass = filter_input(INPUT_POST, ConstantesCrudUsers::PARAM_PASS);
            if($user->pass != null || $user->pass != ""){
                $user->pass = $PasswordStorage->create_hash($user->pass);
            }else{
                $userChecked = $usersSevicios->getUser($user);
                $user->pass = $userChecked->pass;
            }
            
            switch ($action) {
                case ConstantesCrudUsers::INSERT_USER:
                    $userChecked = $usersSevicios->getUser($user);
                    
                    if(!$userChecked){
                        $userChecked = $usersSevicios->addUser($user);
                        
                        if($userChecked){
                            $parameters['mensaje'] = ConstantesCrudUsers::INSERT_YES;
                        }else{
                            $parameters['mensajeError'] = ConstantesCrudUsers::INSERT_ERROR;
                        }
                    }else{
                        $parameters['mensajeError'] = ConstantesCrudUsers::INSERT_NO;
                    }
                    break;
                
                case ConstantesCrudUsers::UPDATE_USER:
                    $userChecked = $usersSevicios->getUser($user);
                    
                    if($userChecked){
                        $userChecked = $usersSevicios->updateUser($user);
                        
                        if($userChecked){
                            $parameters['mensaje'] = ConstantesCrudUsers::UPDATE_YES;
                        }else{
                            $parameters['mensajeError'] = ConstantesCrudUsers::UPDATE_ERROR;
                        }
                    }else{
                        $parameters['mensajeError'] = ConstantesCrudUsers::UPDATE_NO;
                    }
                    break;
                   
                case ConstantesCrudUsers::DELETE_USER:
                    $userChecked = $usersSevicios->getUser($user);
                    
                    if($userChecked){
                        $userChecked = $usersSevicios->deleteUser($user);
                        
                        if($userChecked){
                            $parameters['mensaje'] = ConstantesCrudUsers::DELETE_YES;
                        }else{
                            $parameters['mensajeError'] = ConstantesCrudUsers::DELETE_ERROR;
                        }
                    }else{
                        $parameters['mensajeError'] = ConstantesCrudUsers::DELETE_NO;
                    }
                    break;

            }
        }
        $usuarios = $usersSevicios->getAllUsers();
        $permisos = $usersSevicios->getAllRoles();

            if($usuarios != null && $permisos != null){
               $parameters['usuarios'] = $usuarios;
               $parameters['permisos'] = $permisos;
            }else{
                $parameters['mensaje'] = ConstantesCrudUsers::USERS_NO;
                $parameters['permisos'] = $permisos;
            }
            TwigViewer::getInstance()->viewPage($page,$parameters);
        }else{
            $page = "errors/permissions.html";
            TwigViewer::getInstance()->viewPage($page);
        }
    }
}
