<?php

namespace dao\department;

use dao\DBConnection;
use PDO;
use utils\Constantes;

class DepartmentDAO
{

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
        $stmt = $db->prepare("SELECT u.* FROM users u JOIN permisos p ON (p.id_rol=4 AND p.id_usuario=u.id)");
        $stmt->execute();
        $tics = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbConnection->disconnect();
        return $tics;
    }

    public function modDepartmentoById($departamento, $activo)
    {
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $success = false;
        $activo = $activo ? 1 : 0;
        try {
            $stmt = $db->prepare("UPDATE departamentos SET activo=:activo WHERE id=:id");
            $stmt->bindParam(":id", $departamento);
            $stmt->bindParam(":activo", $activo);
            $success = $stmt->execute();
            $dbConnection->disconnect();
        } catch (\Exception $e) {
            var_dump($e);
            die();
            return false;
        } finally {
            $dbConnection->disconnect();
        }
        return $success;
    }

    public function getDepartamento($id)
    {
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();

        try {
            $stmt = $db->prepare("SELECT * FROM departamentos WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $departamento = $stmt->fetch(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            return false;
        } finally {
            $dbConnection->disconnect();
        }

        return $departamento;
    }

    public
    function addDepartamento($departamento)
    {
        $dbConnection = new DBConnection();

        $db = $dbConnection->getConnection();
        $stmt = $db->prepare("INSERT INTO departamentos (nombre) VALUES (:nombre)");
        $stmt->bindParam(":nombre", $departamento);
        $success = $stmt->execute();
        $dbConnection->disconnect();
        return $success;
    }

    public
    function setEstadoIncidencia($id, $estado)
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
