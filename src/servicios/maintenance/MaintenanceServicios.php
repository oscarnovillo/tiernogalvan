<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
