<?php


namespace servicios\ticusers;

use dao\ticusers\UsersDAO;
use Respect\Validation\Validator as v;
use utils\bolsaTrabajo\BuzonCorreo;
use utils\bolsaTrabajo\ConstantesBD;

use utils\bolsaTrabajo\GenEmail;

use utils\Constantes;
use utils\loginUsers\ConstantesLoginUsers;
use utils\ConstantesPaginas;


class UsersServicios
{

    public function getAllUsers()
    {
        $dao = new UsersDAO();
        return $dao->getAllUsersDAO();
    }

    public function modUserTic($id, $isTic)
    {
        $dao = new UsersDAO();
        return $dao->modUserTic($id, $isTic);
    }

}