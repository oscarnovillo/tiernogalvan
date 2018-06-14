<?php

namespace controllers;

use config\Config;
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
        $rango = $session->checkUserPermission("incidencias_tic") ? "ADMIN" : "USER";
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
                case ConstantesMaintenance::ACTION_DELETE:
                    if ($rango === "ADMIN") {
                        $incidencia = $maintenanceServicios->getIncidenciaById($_REQUEST[ConstantesMaintenance::PARAM_ID]);
                        if (!$incidencia) {
                            $parameters["alert"]["type"] = "error";
                            $parameters["alert"]["message"] = "La incidencia no fue encontrada.";
                        } else {
                            $success = $maintenanceServicios->delIncidenciaById($incidencia->id);
                            if (!$success) {
                                $parameters["alert"]["type"] = "warning";
                                $parameters["alert"]["message"] = "Error al actualizar el registro en la base de datos.";
                            } else {
                                $parameters["alert"]["type"] = "success";
                                $parameters["alert"]["message"] = "Incidencia eliminada correctamente.";
                            }
                        }
                    }
                    break;
                case ConstantesMaintenance::ACTION_ADDCOMMENTCHAT:
                    if ($rango === "ADMIN") {
                        $incidencia = $maintenanceServicios->getIncidenciaById($_REQUEST[ConstantesMaintenance::PARAM_ID]);
                        $usuario = $_SESSION[Constantes::SESS_USER];
                        $comment = isset($_REQUEST[ConstantesMaintenance::PARAM_COMMENT]) ? base64_decode($_REQUEST[ConstantesMaintenance::PARAM_COMMENT]):null;
                        if (!$incidencia) {
                            $parameters["alert"]["type"] = "error";
                            $parameters["alert"]["message"] = "La incidencia no fue encontrada.";
                        } else {
                            $success = $maintenanceServicios->addCommentChat($incidencia->id,$usuario->id,$comment);
                            if (!$success) {
                                $parameters["alert"]["type"] = "warning";
                                $parameters["alert"]["message"] = "Error al agregar comentario.";
                            } else {
                                $parameters["alert"]["type"] = "success";
                                $parameters["alert"]["message"] = "Comentario agregado satisfactoriamente.";
                            }
                        }
                    }
                    break;
                case ConstantesMaintenance::ACTION_INSERT:
                    $incidencia = isset($_REQUEST[ConstantesMaintenance::PARAM_DESCRIPTION]) ? $_REQUEST[ConstantesMaintenance::PARAM_DESCRIPTION]:null;
                    $departamento = $maintenanceServicios->getDepartamentoById($_REQUEST[ConstantesMaintenance::PARAM_DEPARTAMENTO]);
                    /*
                     * Enviar email al usuario actual y a todos los TIC.
                     */
                    $actualUser = $session->getActualUser();
                    $mailer->sendMail($actualUser->email, $actualUser->nombre . " " . $actualUser->apellidos, "Insertada nueva incidencia", "Motivo de la incidencia: " . $incidencia);
                    if (Config::SEND_MAIL_ADMIN_ALERT) {
                        $tics = $maintenanceServicios->getAllTics();
                        foreach ($tics as $tic) {
                            $mailer->sendMail($tic->email, $tic->nombre . " " . $tic->apellidos, "Insertada nueva incidencia", "Motivo de la incidencia: " . $incidencia);
                        }
                    }
                    $usuario = $_SESSION[Constantes::SESS_USER];
                    $lugar = isset($_REQUEST[ConstantesMaintenance::PARAM_LUGAR]) ? $_REQUEST[ConstantesMaintenance::PARAM_LUGAR]:null;
                    $equipo = isset($_REQUEST[ConstantesMaintenance::PARAM_EQUIPO]) ? ConstantesMaintenance::PARAM_EQUIPO:null;
                    if (!$departamento) {
                        $parameters["alert"]["type"] = "error";
                        $parameters["alert"]["message"] = "El departamento indicado no es válido.";
                    } else if ($incidencia == null || $incidencia == "") {
                        $parameters["alert"]["type"] = "error";
                        $parameters["alert"]["message"] = "Debes indicar una incidencia.";
                    } else {
                        $success = $maintenanceServicios->addIncidencia($incidencia, $departamento, $usuario, $lugar, $equipo);
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
        $parameters["mensajes"] = $maintenanceServicios->getAllComments();
        $parameters["permiso"] = $rango;
        $parameters["user"]["id"] = $_SESSION[Constantes::SESS_USER]->id;
        $parameters["param"]["action"] = Constantes::PARAMETER_NAME_ACTION;
        $parameters["param"]["mark_as"] = ConstantesMaintenance::ACTION_MARK;
        $parameters["param"]["delete"] = ConstantesMaintenance::ACTION_DELETE;
        $parameters["param"]["status"] = ConstantesMaintenance::PARAM_STATUS;
        $parameters["param"]["addCommentChat"] = ConstantesMaintenance::ACTION_ADDCOMMENTCHAT;
        $parameters["param"]["comment"] = ConstantesMaintenance::PARAM_COMMENT;
        $parameters["param"]["id"] = ConstantesMaintenance::PARAM_ID;
        TwigViewer::getInstance()->viewPage($page, $parameters);
    }

}
