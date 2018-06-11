<?php

namespace servicios\department;

use dao\department\DepartmentDAO;

class DepartmentServicios
{

    public function getAllDepartamentos()
    {
        $dao = new DepartmentDAO();
        return $dao->getAllDepartamentos();
    }

    public function modDepartmentoById($id, $activo)
    {
        $dao = new DepartmentDAO();
        return $dao->modDepartmentoById($id, $activo);
    }

    public function getDepartamentoById($id)
    {
        $dao = new DepartmentDAO();
        return $dao->getDepartamento($id);
    }

    public function addDepartamento($departamento)
    {
        $dao = new DepartmentDAO();
        return $dao->addDepartamento($departamento);
    }
}
