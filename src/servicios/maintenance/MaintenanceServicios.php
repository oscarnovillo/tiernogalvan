<?php

namespace servicios\maintenance;

use dao\maintenance\MaintenanceDAO;

class MaintenanceServicios
{

    public function getAllIncidencias()
    {
        $dao = new MaintenanceDAO();
        return $dao->getAllIncidencias();
    }

    public function getIncidenciaById($id)
    {
        $dao = new MaintenanceDAO();
        return $dao->getIncidencia($id);
    }

    public function setEstadoIncidenciaById($id, $status)
    {
        $dao = new MaintenanceDAO();
        return $dao->setEstadoIncidencia($id, $status);
    }

}
