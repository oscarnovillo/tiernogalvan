<?php

namespace dao\maintenance;

use dao\DBConnection;
use PDO;
use utils\Constantes;

class MaintenanceDAO
{

    public function getAllIncidencias()
    {
        $dbConnection = new DBConnection();

        $db = $dbConnection->getConnection();
        $stmt = $db->prepare("SELECT i.*,u.nombre as solicitante, d.nombre as departName, i.nombre, i.id, uu.nombre as completado_por_nombre FROM incidencias i 
                                        JOIN users u ON i.solicitado_por=u.id
                                        JOIN departamentos d ON i.departamento=d.id
                                        LEFT JOIN users uu ON (i.completado_por IS NOT NULL AND i.completado_por=uu.id)");
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

    public function getAllTics()
    {
        $dbConnection = new DBConnection();

        $db = $dbConnection->getConnection();
        $stmt = $db->prepare("SELECT u.* FROM users u JOIN permisos p ON p.id_rol=4");
        $stmt->execute();
        $tics = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbConnection->disconnect();
        return $tics;
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
        $stmt->bindParam(":solicitado_por", $usuario->id);
        $stmt->bindParam(":departamento", $departamento->id);
        $success = $stmt->execute();
        $dbConnection->disconnect();
        return $success;
    }

    public function setEstadoIncidencia($id, $estado)
    {
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare("UPDATE incidencias SET estado=:estado,completado_por=:usrid WHERE id=:id");
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":usrid", $_SESSION[Constantes::SESS_USER]->id);
        $success = $stmt->execute();
        $dbConnection->disconnect();
        return $success;
    }

}
