<?php

namespace dao\tareas;

use dao\DBConnection;
use PDO;

/* Hay que borrar estas dos clases en el futuro cuando tenga las tablas en la BBDD */

class Curso {

    public $id_curso;
    public $nombre_curso;
    public $tipo;
    public $turno;

}

class Tarea {

    public $id_tarea;
    public $id_curso;
    public $descripcion;
    public $asignatura;
    public $fecha;

}

class TareasDAO {

    public function getAllCursos() {
        $sql = "SELECT * FROM cursos" .
                " Order By Case tipo" .
                " When 'ESO' Then 1" .
                " When 'BACH' Then 2" .
                " When 'FPB' Then 3" .
                " When 'FPGM' Then 4" .
                " When 'FPGS' Then 5" .
                " Else 6 End, id_curso;";

        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $cursos = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbConnection->disconnect();

        return $cursos;
    }

    public function getTareasFromCurso($curso, $order, $desc, $limit, $offset, $hide_old) {
        $sql = "SELECT *"
                . " FROM tareas"
                . " WHERE id_curso=?";

        if ($hide_old==1){
            $sql = $sql . " and fecha >= CURDATE()";
        }
        
        $sql = $sql . " order by ?";
        
        if ($desc==1){
            $sql = $sql . " desc";
        }
        
        if ($limit>=0 and $offset>=0){
            $sql = $sql . " limit ?";
            $sql = $sql . " offset ?";
        }

        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        
        $stmt->bindParam(1, $curso, PDO::PARAM_INT);
        $stmt->bindParam(2, $order, PDO::PARAM_INT);
        
        if ($limit>=0 and $offset>=0){
            $stmt->bindParam(3, $limit, PDO::PARAM_INT);
            $stmt->bindParam(4, $offset, PDO::PARAM_INT);
        }

        $stmt->execute(); 
            



        $tareas = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbConnection->disconnect();

        return $tareas;
    }

    public function getNombreCurso($curso) {
        $sql = "SELECT nombre_curso"
                . " FROM cursos"
                . " WHERE id_curso=?";

        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($curso));
        $nombre_curso = $stmt->fetchColumn();
        $dbConnection->disconnect();

        return $nombre_curso;
    }

    public function getAsignaturasCurso($curso) {

        $sql = "SELECT DISTINCT asignatura"
                . " FROM tareas"
                . " WHERE id_curso=?";
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($curso));
        $asignaturas = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        $dbConnection->disconnect();

        return $asignaturas;
    }

    public function updateTarea($id, $descripcion, $asignatura, $fecha) {
        $sql = "UPDATE tareas "
                . " SET descripcion=?, asignatura=?, fecha=?"
                . " WHERE id_tarea=?";

        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($descripcion, $asignatura, $fecha, $id));

        $count = $stmt->rowCount();

        $dbConnection->disconnect();

        return $count;
    }

    public function deleteTarea($id) {
        $sql = "DELETE FROM tareas "
                . " WHERE id_tarea=?";

        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));

        $count = $stmt->rowCount();

        $dbConnection->disconnect();

        return $count;
    }

    
    public function crearTarea($id_curso, $descripcion, $asignatura, $fecha) {
        

        $sql = "INSERT INTO tareas (id_curso, descripcion, asignatura, fecha)"
                . " VALUES (?, ?, ?, ?)";

        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id_curso, $descripcion, $asignatura, $fecha));

        $count = $stmt->rowCount();

        $dbConnection->disconnect();

        return $count;
    }
    
    
    public function getTareasCountFromCurso($id_curso, $hide_old) {
        $sql = "SELECT COUNT(*)"
                . " FROM tareas"
                . " WHERE id_curso=?";
        
        if ($hide_old==1){
            $sql = $sql . " and fecha >= CURDATE()";
        }
        
        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id_curso));

        $count = $stmt->fetchColumn();

        $dbConnection->disconnect();

        return $count;
    }
}
