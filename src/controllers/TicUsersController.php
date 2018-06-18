<?php

namespace controllers;

use servicios\ticusers\UsersServicios;
use utils\Constantes;
use utils\ticusers\ConstantesTicUsers;
use utils\maintenance\Utils;
use utils\Mailer;
use utils\TwigViewer;
use servicios\session\SessionServicios;

class TicUsersController
{
    public function crud()
    {

        $session = new SessionServicios();
        /*
         * Revisar el rango, para saber si es un TIC o no.
         * Si es TIC o ADMIN, puede modificar los departamentos.
         */
        $rango = $session->checkUserPermission("incidencias_tic") || $session->checkUserPermission("administrador") ? "ADMIN" : "USER";
        $page = ConstantesTicUsers::TICUSERS_CRUD;
        $parameters = array();
        $usersServices = new UsersServicios();
        /* Ver operaciones primero */
        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            $utils = new Utils();
            $mailer = new Mailer();
            switch ($action) {
                case ConstantesTicUsers::ACTION_MARKAS:
                    if ($rango === "ADMIN") {
                        $user = isset($_REQUEST[ConstantesTicUsers::PARAM_ID]) ? $_REQUEST[ConstantesTicUsers::PARAM_ID] : null;
                        $estado = isset($_REQUEST[ConstantesTicUsers::ACTION_MARKAS]) ? $_REQUEST[ConstantesTicUsers::ACTION_MARKAS] : null;
                        if (!$user || !$estado) {
                            $parameters["alert"]["type"] = "error";
                            $parameters["alert"]["message"] = "El usuario no fue encontrado.";
                        } else {
                            $success = $usersServices->modUserTic($user, $estado == "activo" ? true : false);
                            if (!$success) {
                                $parameters["alert"]["type"] = "warning";
                                $parameters["alert"]["message"] = "Error al actualizar el registro en la base de datos.";
                            } else {
                                $parameters["alert"]["type"] = "success";
                                $parameters["alert"]["message"] = "Usuario actualizado correctamente.";
                            }
                        }
                    }
                    break;
            }
        }

        /* Ahora pintar la tabla y demás */
        $parameters["usuarios"] = $usersServices->getAllUsers();
        $parameters["permiso"] = $rango;
        $parameters["param"]["action"] = Constantes::PARAMETER_NAME_ACTION;
        $parameters["param"]["mark_as"] = ConstantesTicUsers::ACTION_MARKAS;
        $parameters["param"]["status"] = ConstantesTicUsers::PARAM_STATUS;
        $parameters["param"]["id"] = ConstantesTicUsers::PARAM_ID;
        TwigViewer::getInstance()->viewPage($page, $parameters);
    }

}
