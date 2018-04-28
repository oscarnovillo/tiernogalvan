<?php

namespace controllers;

use utils\Constantes;
use utils\maintenance\ConstantesMaintenance;
use servicios\test\TestServicios;
use utils\TwigViewer;

/**
 * Description of TestController
 *
 * @author user
 */
class MaintenanceController {

    //put your code here

    public function index() {

        $page = ConstantesMaintenance::MAINTENANCE_CRUD;
        $parameters = array();

        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            switch ($action) {
                case ConstantesMaintenance::ACTION_PARAMETER:
                    $testServicios = new TestServicios();
                    $parameters["usuarios"] = $testServicios->getAllUsuarios();
                    $page = ConstantesMaintenance::TEST_PAGE;
                    break;
            }
        }

        //con esto se pinta una pagina de twig
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }

}
