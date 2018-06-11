<?php

namespace controllers;

use config\Config;
use servicios\department\DepartmentServicios;
use utils\Constantes;
use utils\departments\ConstantesDepartments;
use utils\maintenance\Utils;
use utils\Mailer;
use utils\TwigViewer;
use servicios\session\SessionServicios;

class DepartmentsController
{
    public function crud()
    {

        $session = new SessionServicios();
        /*
         * Revisar el rango, para saber si es un TIC o no.
         * Si es TIC o ADMIN, puede modificar los departamentos.
         */
        $rango = $session->checkUserPermission("incidencias_tic") || $session->checkUserPermission("administrador") ? "ADMIN" : "USER";
        $page = ConstantesDepartments::DEPARTMENTS_CRUD;
        $parameters = array();
        $departmentServices = new DepartmentServicios();
        /* Ver operaciones primero */
        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            $utils = new Utils();
            $mailer = new Mailer();
            switch ($action) {
                case ConstantesDepartments::ACTION_MARKAS:
                    if ($rango === "ADMIN") {
                        $departamento = isset($_REQUEST[ConstantesDepartments::PARAM_ID]) ? $_REQUEST[ConstantesDepartments::PARAM_ID] : null;
                        $estado = isset($_REQUEST[ConstantesDepartments::ACTION_MARKAS]) ? $_REQUEST[ConstantesDepartments::ACTION_MARKAS] : null;
                        if (!$departamento || !$estado) {
                            $parameters["alert"]["type"] = "error";
                            $parameters["alert"]["message"] = "El departamento no fue encontrado.";
                        } else {
                            $success = $departmentServices->modDepartmentoById($departamento, $estado == "activo" ? true : false);
                            if (!$success) {
                                $parameters["alert"]["type"] = "warning";
                                $parameters["alert"]["message"] = "Error al actualizar el registro en la base de datos.";
                            } else {
                                $parameters["alert"]["type"] = "success";
                                $parameters["alert"]["message"] = "Departamento actualizado correctamente.";
                            }
                        }
                    }
                    break;
                case ConstantesDepartments::ACTION_INSERT:
                    $departamento = isset($_REQUEST[ConstantesDepartments::PARAM_DEPARTAMENTO]) ? $_REQUEST[ConstantesDepartments::PARAM_DEPARTAMENTO] : null;
                    if (!$departamento) {
                        $parameters["alert"]["type"] = "error";
                        $parameters["alert"]["message"] = "El departamento indicado no es válido.";
                    } else {
                        $success = $departmentServices->addDepartamento($departamento);
                        if (!$success) {
                            $parameters["alert"]["type"] = "warning";
                            $parameters["alert"]["message"] = "Error al actualizar el registro en la base de datos.";
                        } else {
                            $parameters["alert"]["type"] = "success";
                            $parameters["alert"]["message"] = "Incidencia agregada correctamente.";
                        }
                    }
                    break;
            }
        }

        /* Ahora pintar la tabla y demás */
        $parameters["departamentos"] = $departmentServices->getAllDepartamentos();
        $parameters["permiso"] = $rango;
        $parameters["param"]["action"] = Constantes::PARAMETER_NAME_ACTION;
        $parameters["param"]["mark_as"] = ConstantesDepartments::ACTION_MARKAS;
        $parameters["param"]["status"] = ConstantesDepartments::PARAM_STATUS;
        $parameters["param"]["id"] = ConstantesDepartments::PARAM_ID;
        TwigViewer::getInstance()->viewPage($page, $parameters);
    }

}
