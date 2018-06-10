<?php

namespace controllers;

use servicios\maintenance\SessionServicios;
use utils\Constantes;
use utils\maintenance\ConstantesMaintenance;
use utils\maintenance\Utils;
use utils\Mailer;
use utils\TwigViewer;

class ErrorController
{

    public function permissions()
    {
        TwigViewer::getInstance()->viewPage("errors/permissions.html");
    }

    public function forbiddenAccess()
    {
        TwigViewer::getInstance()->viewPage("errors/forbidden-access.html");
    }

}
