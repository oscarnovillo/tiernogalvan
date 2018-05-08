<?php

namespace controllers;

use utils\crudUsers\ConstantesCrudUsers;
use utils\Constantes;
use utils\ConstantesPaginas;
use utils\TwigViewer;

/**
 * Description of CrudUsersController
 *
 * @author Erasto
 */

class CrudUsersController {
    
    public function crud(){
        
        $page = ConstantesCrudUsers::CRUD_PAGE;
        $parameters = array();
        
        $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
        
        if (isset($action)) {
            switch ($action) {
                case ConstantesCrudUsers::INSERT_USER:

                    break;
                
                case ConstantesCrudUsers::UPDATE_USER:
                    
                    break;
                
                case ConstantesCrudUsers::DELETE_USER:
                    
                    break;

            }
        }
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }
}
