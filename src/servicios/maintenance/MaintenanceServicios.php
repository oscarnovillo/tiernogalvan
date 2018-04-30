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

}
