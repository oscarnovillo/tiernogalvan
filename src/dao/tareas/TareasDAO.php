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

    public function getAllTareasFromCurso($curso) {
        $sql = "SELECT *"
                . " FROM tareas"
                . " WHERE id_curso=?"
                . " order by fecha";

        $dbConnection = new DBConnection();
        $db = $dbConnection->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute(array($curso));

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
    
}
