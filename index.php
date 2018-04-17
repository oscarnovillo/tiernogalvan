<?php
// Este es el front Controller, se mira la url y los parametros y se llama al controller oportuno.
require_once 'vendor/autoload.php';

use utils\TwigViewer;
use utils\Constantes;
use utils\ConstantesPaginas;


if(isset($_REQUEST[Constantes::PARAMETER_NAME_CONTROLLER]))
{
    $controller = $_REQUEST[Constantes::PARAMETER_NAME_CONTROLLER];
    switch ($controller)
    {
        case Constantes::TEST_CONTROLLER:
            
        break;
    }
}
else
{
    //con esto se pinta una pagina de twig
    TwigViewer::getInstance()->viewPage(ConstantesPaginas::INDEX);
}


