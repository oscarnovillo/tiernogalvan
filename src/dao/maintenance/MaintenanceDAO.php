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

    public function getAllDepartamentos()
    {
        $dbConnection = new DBConnection();

        $db = $dbConnection->getConnection();
        $stmt = $db->prepare("SELECT * FROM departamentos");
        $stmt->execute();
        $departamentos = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbConnection->disconnect();
        return $departamentos;
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

    public function getDepartamento($id)
    {
        $dbConnection = new DBConnection();

        $db = $dbConnection->getConnection();
        $stmt = $db->prepare("SELECT * FROM departamentos WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $departamento = $stmt->fetch(PDO::FETCH_OBJ);
        $dbConnection->disconnect();
        return $departamento;
    }

    public function addIncidencia($incidencia, $departamento, $usuario)
    {
        $dbConnection = new DBConnection();

        $db = $dbConnection->getConnection();
        $stmt = $db->prepare("INSERT INTO incidencias (nombre,solicitado_por,departamento,fecha) VALUES (:nombre,:solicitado_por,:departamento,now())");
        $stmt->bindParam(":nombre", $incidencia);
        $stmt->bindParam(":solicitado_por", $usuario);
        $stmt->bindParam(":departamento", $departamento->id);
        $success = $stmt->execute();
        $dbConnection->disconnect();
        return $success;
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
