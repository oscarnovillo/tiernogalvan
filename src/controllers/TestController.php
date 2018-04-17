<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controllers;

use utils\Constantes;
use utils\test\ConstantesTest;
use servicios\test\TestServicios;
use utils\TwigViewer;

/**
 * Description of TestController
 *
 * @author user
 */
class TestController {

    //put your code here

    public function index() {
        
        $page = ConstantesTest::TEST_INDEX;
        $parameters = array();
       
        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            switch ($action) {
                case ConstantesTest::ACTION_PARAMETER:
                    $testServicios = new TestServicios();
                    $parameters["usuarios"] = $testServicios->getAllUsuarios();
                    $page = ConstantesTest::TEST_PAGE;
                    break;
            }
        }

        //con esto se pinta una pagina de twig
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }

}
