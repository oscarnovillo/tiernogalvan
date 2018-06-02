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
            $user->pass = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_PASS);
            $user->nick = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_NICK);
            $user->nombre = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_NOMBRE);
            $user->apellidos = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_APELLIDOS);
            $user->telefono = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_TELEFONO);
            $user->email = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_EMAIL);
            $palabra_clave = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_PALABRA_CLAVE);
            
            switch ($action) {
                case ConstantesLoginUsers::LOGIN_USER:
                    
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
                    
                    if($user->nick != null){//la primera vez que entra que mande a la pag de registro
                        //la segunda vez, rellenado el form debera pasar
                    
                        $userChecked = $usersSevicios->getUserByNick($user);

                        if(!$userChecked){

                            $user->pass = $PasswordStorage->create_hash($user->pass);
                            $user->activado = 0;

                            switch ($palabra_clave){

                                case Constantes::PERMISO_ALUMNO:
                                    $user->id_rol = Constantes::ID_ROL_ALUMNO;
                                    break;

                                case Constantes::PERMISO_PROFESOR:
                                    $user->id_rol = Constantes::ID_ROL_PROFESOR;
                                    break;

                                case Constantes::PERMISO_ADMIN:
                                    $user->id_rol = Constantes::ID_ROL_ADMIN;
                                    break;
                                default:
                                    $parameters['mensaje'] = ConstantesLoginUsers::PERMISO_FAIL;
                                    break;
                            }
                            $userChecked = $usersSevicios->addUser($user);

                            if($userChecked){
                                
                                $cod_act = $usersSevicios->random_code(ConstantesLoginUsers::TAMAÑO_RANDOM);
                                
                                sendMail($user->email, $user->nombre . " " . $user->apellidos, 
                                        "Código de activación I.E.S. Enrique Tierno Galván", "Codigo de activación: http://localhost:8000/index.php?c=login_users?a=activar?cod_act=".$cod_act);//esto hay que cambiarlo
                                
                            }else{
                                $parameters['mensaje'] = ConstantesLoginUsers::REGISTRO_ERROR;
                            }

                        }else{
                            $parameters['mensaje'] = ConstantesLoginUsers::INVALID_USER;
                        }

                        $page = ConstantesLoginUsers::REGISTRO_PAGE;
                        
                    }else{
                        $page = ConstantesLoginUsers::REGISTRO_PAGE;
                    }
                    
                case ConstantesLoginUsers::ACTIVATE_USER:
                    
                    $cod_act = filter_input(INPUT_POST, ConstantesLoginUsers::COD_ACT);
                    //comprueba con el de la bd
                    //si si si 
                    //si no no
                    
                    break;
            }
        }
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }
    
}
