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

    public function getIncidencia($id)
    {
        $dbConnection = new DBConnection();

        $db = $dbConnection->getConnection();
        $stmt = $db->prepare("SELECT * FROM incidencias WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $incidencia = $stmt->fetch(PDO::FETCH_OBJ);
        $dbConnection->disconnect();
        return $incidencia;
    }

    public function setEstadoIncidencia($id, $estado)
    {
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare("UPDATE incidencias SET estado=:estado WHERE id=:id");
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":id", $id);
        $success = $stmt->execute();
        $dbConnection->disconnect();
        return $success;
    }

}
