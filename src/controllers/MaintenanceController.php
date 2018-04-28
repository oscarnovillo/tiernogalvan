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
        $testServicios = new MaintenanceServicios();
        $parameters["incidencias"] = $testServicios->getAllIncidencias();

        TwigViewer::getInstance()->viewPage($page,$parameters);
    }

}
