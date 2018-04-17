<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace dao;

use utils\Constantes;
use config\Config;
/**
 * Description of DBConnection
 *
 * @author user
 */
class DBConnection {
    
    private $db = NULL;
    //put your code here
    public function getConnection()
    {
        $this->db = new MysqliDb(Config::DB_SERVER_NAME, Config::DB_USER_NAME, Config::DB_PASSWORD, Config::DB_DATABASE);
        return $this->db;
    }
    
    public function disconnect()
    {
        if ($this->db != NULL){
           $this->db->disconnect();
        }
    }
}
