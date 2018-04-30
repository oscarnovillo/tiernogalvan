<?php

namespace controllers;

use servicios\maintenance\MaintenanceServicios;
use utils\Constantes;
use utils\maintenance\ConstantesMaintenance;
use utils\TwigViewer;

class MaintenanceController {

    public function crud()
    {
        //TODO: actualizar permisos para que se vean las cosas por permisos
        $rango = "ADMIN";

        $page = ConstantesMaintenance::MAINTENANCE_CRUD;
        $parameters = array();
        $maintenanceServicios = new MaintenanceServicios();
        $parameters["incidencias"] = $maintenanceServicios->getAllIncidencias();
        $parameters["permiso"] = $rango;
        $parameters["action"] = Constantes::PARAMETER_NAME_ACTION;
        $parameters["mark_as"] = ConstantesMaintenance::ACTION_MARK;

        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            if ($rango === "ADMIN") {
                switch ($action) {
                    case ConstantesMaintenance::ACTION_MARK:
                        echo "marcar aqui";
                        die();
                        break;
                }
            }
        }

        //TODO: meter el solicitado por con las claves foraneas entre usuarixs
        //TODO: probar para profe y para admin
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }

}
