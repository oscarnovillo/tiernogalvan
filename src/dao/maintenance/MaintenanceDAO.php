<?php

namespace dao\maintenance;

use dao\DBConnection;
use PDO;

class MaintenanceDAO
{

    public function getAllIncidencias()
    {
        $dbConnection = new DBConnection();

        $db = $dbConnection->getConnection();
        $stmt = $db->prepare("SELECT * FROM incidencias");
        $stmt->execute();
        $incidencias = $stmt->fetchAll(PDO::FETCH_OBJ);


        $dbConnection->disconnect();

        return $incidencias;
    }

}
