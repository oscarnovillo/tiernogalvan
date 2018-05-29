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
                    /*
                     * ERASTO LEEMEE :))
                     * TODO: erasto, aqui comprueba si se conecta por el form. lo de dentro del if puedes dejarlo igual.
                     * También tienes que cambiar las variables de id de usuario y permiso de usuario (los coges cuando se conecte).
                     */
                    $conexionValida = true; //programar esto
                    $idUsuario = 1; //programar esto
                    $idPermiso = 1; //programar esto

                    /*
                     * A partir de aquí nada. Esto es mágico.
                     */
                    if ($conexionValida) {
                        $_SESSION[Constantes::SESS_USER] = $idUsuario;
                        $_SESSION[Constantes::SESS_PERMISSION] = $idPermiso;
                    }
                    
                    break;
                
                case ConstantesCrudUsers::REGISTER_USER:
                    
                    break;
            }
        }
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }
}
