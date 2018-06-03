<?php

namespace controllers;

use servicios\maintenance\SessionServicios;
use utils\Constantes;
use utils\maintenance\ConstantesMaintenance;
use utils\maintenance\Utils;
use utils\Mailer;
use utils\TwigViewer;

class LogoutController
{

    public function logout()
    {
        $_SESSION[Constantes::SESS_USER] = null;
        header("Location: /index.php?c=" . Constantes::HOME_CONTROLLER);
    }

}
