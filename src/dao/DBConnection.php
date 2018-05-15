<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace dao;

use PDO;
use utils\Constantes;
use config\Config;


/**
 * Description of DBConnection
 *
 * @author user
 */
class DBConnection
{

    private $db = NULL;

    //put your code here
    public function getConnection()
    {
        try {
            $dsn = "mysql:host=" . Config::DB_SERVER_NAME . ";dbname=" . Config::DB_DATABASE . ";charset=utf8";
            $this->db = new PDO($dsn, Config::DB_USER_NAME, Config::DB_PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $this->db;
    }

    public function disconnect()
    {
        if ($this->db != NULL) {
            $this->db = NULL;
        }
    }

}
