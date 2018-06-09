<?php

namespace controllers;

use servicios\users\UsersServicios;
use utils\bolsaTrabajo\BuzonCorreo;
use utils\Constantes;
use utils\loginUsers\ConstantesLoginUsers;
use utils\PasswordStorage;
use utils\TwigViewer;


/**
 * Description of LoginUsers
 *
 * @author Erasto
 */
class LoginUsers
{

    public function login()
    {

        $page = ConstantesLoginUsers::START_PAGE;
        $usersSevicios = new UsersServicios();
        $parameters = array();

        $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];

        if (isset($action)) { 

            $PasswordStorage = new PasswordStorage();
            $user = new \stdClass;
            $user->pass = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_PASS);
            $user->nick = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_NICK);
            $user->nombre = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_NOMBRE);
            $user->apellidos = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_APELLIDOS);
            $user->telefono = intval (filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_TELEFONO));
            $user->email = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_EMAIL);
            $palabra_clave = filter_input(INPUT_POST, ConstantesLoginUsers::PARAM_PALABRA_CLAVE);

            switch ($action) {
                case ConstantesLoginUsers::LOGIN_USER:

                    if($usersSevicios->validarLogin($user)){

                        $userChecked = $usersSevicios->getUserByNick($user);

                        if ($userChecked) {

                            if ($PasswordStorage->verify_password($user->pass, $userChecked->pass)) {

                                if ($userChecked->activado === "1") {

                                    $userChecked->date = date("Y-m-d");

                                    $usersSevicios->updateFechaUser($userChecked);

                                    $userChecked = $usersSevicios->getPermisoUser($userChecked);
                                    $_SESSION[Constantes::SESS_USER] = $userChecked;
                                    $parameters['mensaje'] = $userChecked->nombre . " " . $userChecked->apellidos;
                                    $page = ConstantesLoginUsers::LOGIN_PAGE;

                                }else{
                                    $parameters['mensajeLoginError'] = ConstantesLoginUsers::ACTIVO_NO;
                                }
                            }else{
                                $parameters['mensajeLoginError'] = ConstantesLoginUsers::LOGIN_ERROR;
                            }
                        }else{
                            $parameters['mensajeLoginError'] = ConstantesLoginUsers::LOGIN_NO;
                        }

                    }else{
                        $parameters['mensajeLoginError'] = ConstantesLoginUsers::PARAMETROS_MAL;
                    }
                    break;

                case ConstantesLoginUsers::REGISTER_USER:

                    BuzonCorreo::getInstance()->setRemitenteNombre(ConstantesLoginUsers::ASUNTO_MAIL);

                    if ($user->nick != null) {

                        if($usersSevicios->validarUser($user)){
                            
                            if($usersSevicios->validarEmail($user)){
                                
                                if($usersSevicios->validarTelefono($user)){

                                    $userChecked = $usersSevicios->getUserByNick($user);

                                    if (!$userChecked) {

                                        $user->pass = $PasswordStorage->create_hash($user->pass);
                                        $user->activado = 0;

                                        switch ($palabra_clave) {//FALTA ARREGLO

                                            case Constantes::PERMISO_ALUMNO:
                                                $user->id_rol = Constantes::ID_ROL_ALUMNO;
                                                break;

                                            case Constantes::PERMISO_PROFESOR:
                                                $user->id_rol = Constantes::ID_ROL_PROFESOR;
                                                break;

                                            case Constantes::PERMISO_ADMIN:
                                                $user->id_rol = Constantes::ID_ROL_ADMIN;
                                                break;

                                            case Constantes::PERMISO_INCIDENCIAS_TIC:
                                                $user->id_rol = Constantes::ID_INCIDENCIAS_TIC;
                                                break;

                                            case Constantes::PERMISO_EMPRESA:
                                                $user->id_rol = Constantes::ID_ROL_EMPRESA;
                                                break;

                                            default:
                                                $parameters['mensajeRegistroError'] = ConstantesLoginUsers::PERMISO_FAIL;
                                                break;
                                        }
                                        $user->codigo_activacion = $usersSevicios->random_code(ConstantesLoginUsers::TAMAÑO_RANDOM);
                                        $userChecked = $usersSevicios->addUser($user);

                                        if ($userChecked) {

                                            BuzonCorreo::getInstance()->enviarCorreo($user->email, $user->nombre . " " . $user->apellidos, "registro", "<a href=http://localhost:8000/index.php?c=login_users&a=activar&cod_act=".$user->codigo_activacion."&nick=".$user->nick.">Para activar tu cuenta Pulsa Aquí</a>");

                                            $parameters['mensajeRegistro'] = ConstantesLoginUsers::SENT_EMAIL;

                                        } else {
                                            $parameters['mensajeRegistroError'] = ConstantesLoginUsers::REGISTRO_ERROR;
                                        }
                                    }else{
                                        $parameters['mensajeRegistroError'] = ConstantesLoginUsers::USER_EXISTE;
                                    }
                                }else{
                                    $parameters['mensajeRegistroError'] = ConstantesLoginUsers::TELEFONO_MAL;
                                }
                            }else{
                                $parameters['mensajeRegistroError'] = ConstantesLoginUsers::MAIL_MAL;
                            }
                        } else {
                            $parameters['mensajeRegistroError'] = ConstantesLoginUsers::INVALID_USER;
                        }
                    } 
                    $page = ConstantesLoginUsers::REGISTRO_PAGE;


                    break;

                case ConstantesLoginUsers::ACTIVATE_USER:

                    BuzonCorreo::getInstance()->setRemitenteNombre(ConstantesLoginUsers::ASUNTO_MAIL);

                    $cod_act = $_REQUEST[ConstantesLoginUsers::COD_ACT];
                    $user->nick = $_REQUEST[ConstantesLoginUsers::PARAM_NICK];
                    
                    $userChecked = $usersSevicios->getUserByNick($user);

                    if ($cod_act === $userChecked->codigo_activacion) {

                        $userChecked->activado = 1;

                        $activar = $usersSevicios->activarCuenta($userChecked);

                        if ($activar) {
                            BuzonCorreo::getInstance()->enviarCorreo($userChecked->email, "probando", "registro", ConstantesLoginUsers::CUENTA_ACTIVADA);

                        } else {
                            BuzonCorreo::getInstance()->enviarCorreo($userChecked->email, "probando", "registro", ConstantesLoginUsers::ACTIVAR_FAIL);
                        }

                    } else {
                        BuzonCorreo::getInstance()->enviarCorreo($userChecked->email, "probando", "registro", ConstantesLoginUsers::INVALID_COD);
                    }

                    break;

                case ConstantesLoginUsers::RECUPERATE_PASS:

                    BuzonCorreo::getInstance()->setRemitenteNombre("Recuperar Contraseña");

                    if ($user->nick != null) {    
                    
                        if($usersSevicios->validarRecuperarPass($user)){

                            $userChecked = $usersSevicios->getUserByNick($user);

                            if ($userChecked) {
                                $pass_created = $usersSevicios->random_code(ConstantesLoginUsers::TAMAÑO_GENERAR_PASS);
                                $user->pass = $PasswordStorage->create_hash($pass_created);
                                $updateOk = $usersSevicios->updatePass($user);

                                if ($updateOk) {
                                    BuzonCorreo::getInstance()->enviarCorreo($user->email, "probando", "registro", "Tu nueva contraseña generada es : <a href='#'>$pass_created</a> (Puedes cambiarla en Ajustes de Usuario).<br> Tu Nick es : <a href='#'>$userChecked->nick</a>");
                                    $parameters['mensajeRegistro'] = ConstantesLoginUsers::EMAIL_SENT;

                                } else {
                                    $parameters['mensajeRegistroError'] = ConstantesLoginUsers::UPDATE_PASS_FAIL;
                                }

                            } else {
                                $parameters['mensajeRegistroError'] = ConstantesLoginUsers::INVALID_USER;
                            }
                        }else{
                            $parameters['mensajeRegistroError'] = ConstantesLoginUsers::MAL_CAMPO;
                        }    

                }
                $page = ConstantesLoginUsers::RECUPERAR_PAGE;
                break;

                case ConstantesLoginUsers::CHANGE_PASS:
                    
                    if ($user->nick != null) {
                        
                        $user->nuevo_pass = $_REQUEST[ConstantesLoginUsers::NUEVO_PASS];
                        
                        if($usersSevicios->validarCambiarPass($user)){
                        
                            $userChecked = $usersSevicios->getUserByNick($user);

                            if ($userChecked) {
                                   
                                if($PasswordStorage->verify_password($user->pass, $userChecked->pass)){
                                
                                    $user->pass = $PasswordStorage->create_hash($user->nuevo_pass);
                                    $updateOk = $usersSevicios->updatePass($user);

                                    if ($updateOk) {
                                        $parameters['mensajeRegistro'] = ConstantesLoginUsers::PASS_UP_YES;

                                    } else {
                                        $parameters['mensajeRegistroError'] = ConstantesLoginUsers::PASS_UP_NO;
                                    }
                                }else{
                                    $parameters['mensajeRegistroError'] = ConstantesLoginUsers::LOGIN_ERROR;
                                }
                            } else {
                                $parameters['mensajeRegistroError'] = ConstantesLoginUsers::LOGIN_NO;
                            }
                        }else{
                            $parameters['mensajeRegistroError'] = ConstantesLoginUsers::MAL_CAMPO;
                        }    

                    }
                    $page = ConstantesLoginUsers::SETTINGS_PAGE;
                        break;
            }
                 
        }
        TwigViewer::getInstance()->viewPage($page, $parameters);
    }
}