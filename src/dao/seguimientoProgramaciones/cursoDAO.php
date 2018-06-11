<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace dao\seguimientoProgramaciones;

/**
 * Description of cursoDAO
 *
 * @author Sergio
 */
use utils\seguimientoProgramaciones\ConstantesBD;
use dao\DBConnection;
use utils\seguimientoProgramaciones\constantesMensajes;
use PDO;

class cursoDAO {

    public function get_all_cursos() {
        try {
            $connectionDB = new DBConnection();
            $conn = $connectionDB->getConnection();
            $stmt = $conn->prepare(ConstantesBD::GET_ALL_CURSOS);
            $stmt->execute();
            $cursos = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $cursos;
        } catch (Exception $ex) {
            
        } finally {
            $connectionDB->disconnect();
        }
    }

    public function get_curso_asignatura($asignatura) {
        try {
            $connectionDB = new DBConnection();
            $conn = $connectionDB->getConnection();
            $stmt = $conn->prepare(ConstantesBD::get_curso_asignatura);
            $stmt->bindParam(1, $asignatura->id_asignatura);
            $stmt->execute();
            $cursos = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $cursos;
        } catch (Exception $ex) {
            
        } finally {
            $connectionDB->disconnect();
        }
    }

}
