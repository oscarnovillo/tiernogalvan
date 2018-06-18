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

    public function delIncidenciaById($id)
    {
        $dao = new MaintenanceDAO();
        return $dao->delIncidencia($id);
    }

    public function getAllDepartamentos()
    {
        $dao = new MaintenanceDAO();
        return $dao->getAllDepartamentos();
    }

    /*
     * Devuelve todos los TIC del departamento, los cuales pueden resolver incidencias.
     */
    public function getAllTics()
    {
        $dao = new MaintenanceDAO();
        return $dao->getAllTics();
    }

    public function getDepartamentoById($id)
    {
        $dao = new MaintenanceDAO();
        return $dao->getDepartamento($id);
    }

    public function addIncidencia($incidencia, $departamento, $usuario, $lugar, $equipo)
    {
        $dao = new MaintenanceDAO();
        return $dao->addIncidencia($incidencia, $departamento, $usuario, $lugar, $equipo);
    }
    public function addCommentChat($incidencia, $usuario, $comment)
    {
        $dao = new MaintenanceDAO();
        return $dao->addCommentChat($incidencia, $usuario, $comment);
    }
    public function getAllComments()
    {
        $dao = new MaintenanceDAO();
        return $dao->getAllComments();
    }
}
