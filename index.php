<?php
// Este es el front Controller, se mira la url y los parametros y se llama al controller oportuno.
require_once 'vendor/autoload.php';

use controllers\BolsaTrabajoController;
use controllers\MaintenanceController;
use controllers\TestController;
use controllers\VentaLibrosController;
use controllers\LoginUsers;
use controllers\CrudUsersController;
use controllers\AdministracionDocumentosController;
use controllers\TareasController;
use utils\Constantes;
use utils\ConstantesPaginas;
use utils\loginUsers\ConstantesLoginUsers;
use utils\TwigViewer;
use servicios\session\SessionServicios;
use controllers\ErrorController;
use controllers\LogoutController;


/*
 * Mostrar errores sólo si es en localhost, a modo de debugging.
 */
if (in_array($_SERVER['REMOTE_ADDR'], ["127.0.0.1", "::1"])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

/*
 * Inicializar sesión.
 */
session_start();

/*
 * Inicializar session de datos del usuario.
 * En cada controlador se comprueba si se requiere login o no.
 */
/*
 * TODO: HACER CRUD DE DEPARTAMENTOS.
 */
if(isset($_REQUEST[Constantes::PARAMETER_NAME_CONTROLLER]))
{
    $controller = $_REQUEST[Constantes::PARAMETER_NAME_CONTROLLER];
    $userSessionValid = (new SessionServicios())->isUserConnected();
    $errController = new ErrorController();
    switch ($controller)
    {
        case Constantes::TEST_CONTROLLER:
            $controller = new TestController();
            /* Requerir login */
            $userSessionValid ? $controller->index() : $errController->permissions();

            /*
             * ¿No quieres requerir login? Simplemente llama al conmtrolador comentando la línea ternaria $userSessionValid ? [...]
             * $controller->index();
             */
            break;
        case Constantes::MAINTENANCE_CONTROLLER:
            $controller = new MaintenanceController();
            /* Requerir login */
            $userSessionValid ? $controller->crud() : $errController->permissions();
            break;
        case Constantes::BOLSA_TRABAJO_CONTROLLER:
            $controller = new BolsaTrabajoController();
            /* Requerir login */
            !$userSessionValid ? $controller->bolsaTrabajoMain() : $errController->permissions();
            break;
        case Constantes::DOCUMENTOS_CONTROLLER:
            $controller = new AdministracionDocumentosController();
            /* Requerir login */
           // !$userSessionValid ? $controller->documentos() : $errController->permissions();
            $controller->documentos();
        case Constantes::VENTA_LIBROS_CONTROLLER:
            $controller = new VentaLibrosController();
            /* Requerir login */
            $userSessionValid ? $controller->ventas() : $errController->permissions();
            break;
        case Constantes::TAREAS_CONTROLLER:
            $controller = new TareasController();
            /* Requerir login */
            $userSessionValid ? $controller->tareas() : $errController->permissions();
            break;
        case Constantes::CRUD_CONTROLLER:
            $controller = new CrudUsersController();
            /* Requerir login */
            $controller->crud();
            //$userSessionValid ? $controller->crud() : $errController->permissions();
            break;
        case Constantes::LOGIN_CONTROLLER:
            $controller = new LoginUsers();
            /* Requerir login */
            //$userSessionValid ? $controller->login() : $errController->permissions();
            $controller->login();
            break;
        case Constantes::DISCONNECT_CONTROLLER:
            $controller = new LogoutController();
            /* Requerir login */
            $userSessionValid ? $controller->logout() : $errController->permissions();
            break;
        default:
            //TwigViewer::getInstance()->viewPage(ConstantesPaginas::INDEX);
            if($userSessionValid){
                $user = $_SESSION[Constantes::SESS_USER];
                $parameters['mensaje'] = $user->nombre." ".$user->apellidos;
                TwigViewer::getInstance()->viewPage(ConstantesLoginUsers::LOGIN_PAGE,$parameters);
            }else{
                
                              
                TwigViewer::getInstance()->viewPage(ConstantesPaginas::INDEX);
            }    
    }
}
else
{
    //con esto se pinta una pagina de twig
    TwigViewer::getInstance()->viewPage(ConstantesPaginas::INDEX);
}


