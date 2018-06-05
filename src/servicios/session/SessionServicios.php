<?php

namespace servicios\session;

use  dao\users\UsersDAO;
use utils\Constantes;

class SessionServicios
{

    /*
     * Devuelve boolean. Revisa si el usuario está conectado.
     */
    public function isUserConnected()
    {
        if (isset($_SESSION[Constantes::SESS_USER]) && (new UsersDAO())->getUserByIdDao($_SESSION[Constantes::SESS_USER]) !== false) {
            return true;
        }
        return false;
    }

    /*
     * Revisa si el usuario tiene un permiso (por ID).
     * Devuelve boolean.
     */
    public function checkUserPermission($reqPermission)
    {
        if (!$this->isUserConnected()) {
            return false;
        }
        $usersDao = new UsersDAO();
        $permissions = $usersDao->getUserPermissionsByIdDao($_SESSION[Constantes::SESS_USER]->id);
        foreach ($permissions as $permission) {
            if ($permission->rank_name == $reqPermission) {
                return true;
            }
        }
        return false;
    }

    /*
     * Devuelve los datos del usuario actual.
     */
    public function getActualUser()
    {
        if (!$this->isUserConnected()) {
            return false;
        }
        $usersDao = new UsersDAO();
        return $usersDao->getUserByIdDao($_SESSION[Constantes::SESS_USER]);
    }
}
