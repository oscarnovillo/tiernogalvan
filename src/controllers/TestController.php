<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controllers;

use utils\Constantes;
use utils\ConstantesPaginas;

/**
 * Description of TestController
 *
 * @author user
 */
class TestController {

    //put your code here

    public function index() {
        $page = ConstantesPaginas::TEST_INDEX;
        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $controller = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            switch ($controller) {
                case Constantes::TEST_CONTROLLER:
                    $page = ConstantesPaginas::TEST_PAGE;
                    break;
            }
        }

        //con esto se pinta una pagina de twig
        TwigViewer::getInstance()->viewPage(ConstantesPaginas::TEST_INDEX);
    }

}
