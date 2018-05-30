<?php

namespace controllers;

use servicios\maintenance\MaintenanceServicios;
use utils\Constantes;
use utils\maintenance\ConstantesMaintenance;
use utils\maintenance\Utils;
use utils\Mailer;
use utils\TwigViewer;
use servicios\session\SessionServicios;

class MaintenanceController
{

    public function crud()
    {

        $session = new SessionServicios();
        /*
         * Revisar el rango, para saber si es un TIC o no.
         * Si es TIC, puede marcar el estado de las consultas.
         */
        $rango = $session->checkUserPermission(4) ? "ADMIN" : "USER";

        $page = ConstantesMaintenance::MAINTENANCE_CRUD;
        $parameters = array();
        $maintenanceServicios = new MaintenanceServicios();
        /* Ver operaciones primero */
        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            $utils = new Utils();
            $mailer = new Mailer();
            switch ($action) {
                case ConstantesMaintenance::ACTION_MARK:
                    if ($rango === "ADMIN") {
                        $incidencia = $maintenanceServicios->getIncidenciaById($_REQUEST[ConstantesMaintenance::PARAM_ID]);
                        $nuevoEstado = $_REQUEST[ConstantesMaintenance::PARAM_STATUS];
                        if (!$incidencia) {
                            $parameters["alert"]["type"] = "error";
                            $parameters["alert"]["message"] = "La incidencia no fue encontrada.";
                        } else if ($incidencia->estado === "completado") {
                            $parameters["alert"]["type"] = "error";
                            $parameters["alert"]["message"] = "La incidencia ya estaba completada y su estado no puede ser cambiado.";
                        } else if (!$utils->isValidStatus($nuevoEstado)) {
                            $parameters["alert"]["type"] = "error";
                            $parameters["alert"]["message"] = "El estado indicado no es válido.";
                        } else {
                            $success = $maintenanceServicios->setEstadoIncidenciaById($incidencia->id, $nuevoEstado);
                            if (!$success) {
                                $parameters["alert"]["type"] = "warning";
                                $parameters["alert"]["message"] = "Error al actualizar el registro en la base de datos.";
                            } else {
                                $parameters["alert"]["type"] = "success";
                                $parameters["alert"]["message"] = "Estado actualizado correctamente.";
                            }
                        }
                    }
                    break;
                case ConstantesMaintenance::ACTION_INSERT:
                    $incidencia = $_REQUEST[ConstantesMaintenance::PARAM_DESCRIPTION];
                    $departamento = $maintenanceServicios->getDepartamentoById($_REQUEST[ConstantesMaintenance::PARAM_DEPARTAMENTO]);
                    /*
                     * Enviar email al usuario actual y a todos los TIC.
                     */
                    $actualUser = $session->getActualUser();
                    $mailer->sendMail($actualUser->email, $actualUser->nombre . " " . $actualUser->apellidos, "Insertada nueva incidencia", "Motivo de la incidencia: " . $incidencia);
                    $tics = $maintenanceServicios->getAllTics();
                    foreach ($tics as $tic) {
                        $mailer->sendMail($tic->email, $tic->nombre . " " . $tic->apellidos, "Insertada nueva incidencia", "Motivo de la incidencia: " . $incidencia);
                    }
                    $usuario = $_SESSION[Constantes::SESS_USER];
                    if (!$departamento) {
                        $parameters["alert"]["type"] = "error";
                        $parameters["alert"]["message"] = "El departamento indicado no es válido.";
                    } else if ($incidencia == null || $incidencia == "") {
                        $parameters["alert"]["type"] = "error";
                        $parameters["alert"]["message"] = "Debes indicar una incidencia.";
                    } else {
                        $success = $maintenanceServicios->addIncidencia($incidencia, $departamento, $usuario);
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
        $parameters["incidencias"] = $maintenanceServicios->getAllIncidencias();
        $parameters["departamentos"] = $maintenanceServicios->getAllDepartamentos();
        $parameters["permiso"] = $rango;
        $parameters["param"]["action"] = Constantes::PARAMETER_NAME_ACTION;
        $parameters["param"]["mark_as"] = ConstantesMaintenance::ACTION_MARK;
        $parameters["param"]["status"] = ConstantesMaintenance::PARAM_STATUS;
        $parameters["param"]["id"] = ConstantesMaintenance::PARAM_ID;
        TwigViewer::getInstance()->viewPage($page, $parameters);
    }

}
