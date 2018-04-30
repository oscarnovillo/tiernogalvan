<?php

namespace controllers;

use servicios\maintenance\MaintenanceServicios;
use utils\maintenance\ConstantesMaintenance;
use utils\TwigViewer;

class MaintenanceController {

    public function crud()
    {
        $page = ConstantesMaintenance::MAINTENANCE_CRUD;
        $parameters = array();
        $maintenanceServicios = new MaintenanceServicios();
        $parameters["incidencias"] = $maintenanceServicios->getAllIncidencias();
        //TODO: actualizar permisos para que se vean las cosas por permisos
        $parameters["permiso"] = "PROFESOR";

        //TODO: meter el solicitado por con las claves foraneas entre usuarixs
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }

}
