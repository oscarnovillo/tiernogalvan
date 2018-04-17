<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace servicios\test;

use dao\test\TestDAO;

/**
 * Description of TestServicios
 *
 * @author user
 */
class TestServicios {

    //put your code here

    public function getAllUsuarios() {
        $dao = new TestDAO();

        return $dao->getAllUsuarios();
    }

}
