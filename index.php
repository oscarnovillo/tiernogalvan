<?php
// Este es el front Controller, se mira la url y los parametros y se llama al controller oportuno.
require_once 'vendor/autoload.php';

use controllers\BolsaTrabajoController;
use controllers\MaintenanceController;
use controllers\TestController;
use controllers\VentaLibrosController;
use utils\Constantes;
use utils\ConstantesPaginas;
use utils\TwigViewer;


if(isset($_REQUEST[Constantes::PARAMETER_NAME_CONTROLLER]))
{
    $controller = $_REQUEST[Constantes::PARAMETER_NAME_CONTROLLER];
    switch ($controller)
    {
        case Constantes::TEST_CONTROLLER:
            $controller = new TestController();
            $controller->index();
            break;
        case Constantes::MAINTENANCE_CONTROLLER:
            $controller = new MaintenanceController();
            $controller->crud();
            break;
        case Constantes::BOLSA_TRABAJO_CONTROLLER:
            $controller = new BolsaTrabajoController();
            $controller->bolsaTrabajoMain();
            break;
        case Constantes::VENTA_LIBROS_CONTROLLER:
            $controller = new VentaLibrosController();
            $controller->ventas();
            break;
    }
}
else
{
    //con esto se pinta una pagina de twig
    TwigViewer::getInstance()->viewPage(ConstantesPaginas::INDEX);
}


