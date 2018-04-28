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

        TwigViewer::getInstance()->viewPage($page,$parameters);
    }

}
