<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace dao\test;

use dao\DBConnection;
/**
 * Description of TestDAO
 *
 * @author user
 */
class TestDAO {
    //put your code here
    
    public function getAllUsuarios()
    {
        $dbConnection = new DBConnection();
        
        $db = $dbConnection->getConnection();
        $usuarios = $db->get('USERS');
       
        
        $dbConnection->disconnect();
        
        return $usuarios;
    }
}
