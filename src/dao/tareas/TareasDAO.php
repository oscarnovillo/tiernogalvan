<?php

namespace dao\tareas;

use dao\DBConnection;
use PDO;

/* Hay que borrar estas dos clases en el futuro cuando tenga las tablas en la BBDD */

class Tarea {

    public $id_tarea;
    public $id_curso;
    public $descripcion;
    public $asignatura;
    public $fecha;
}

class Curso {
    public $id_curso;
    public $nombre_curso;

}

class TareasDAO {

    public function getAllTareasFromCurso($curso) {
//        $dbConnection = new DBConnection();
//
//        $db = $dbConnection->getConnection();
//        $stmt = $db->prepare("SELECT * FROM user");
//        $stmt->execute();
//        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
//
//
//        $dbConnection->disconnect();

        /* CutreTask Simulator 5.0 */
        switch ($curso) {
            case 1:
                $tarea1 = new Tarea();
                $tarea1->descripcion = 'tarea 1';
                $tarea1->asignatura = 'Bases de datos';
                $tarea1->fecha = 'mañana';

                $tarea2 = new Tarea();
                $tarea2->descripcion = 'tarea 2';
                $tarea2->asignatura = 'Sistemas';
                $tarea2->fecha = 'pasado mañana';

                $tarea3 = new Tarea();
                $tarea3->descripcion = 'tarea 3';
                $tarea3->asignatura = 'asignatura';
                $tarea3->fecha = 'fecha';

                $tareas = array($tarea1, $tarea2, $tarea3);
                break;

            case 2:
                $tarea1 = new Tarea();
                $tarea1->descripcion = 'Guti debe quitar este DAO simulado y llamar a la BBDD';
                $tarea1->asignatura = 'PFC';
                $tarea1->fecha = 'Lo antes posible';

                $tarea2 = new Tarea();
                $tarea2->descripcion = 'Entregar proyecto';
                $tarea2->asignatura = 'PFC';
                $tarea2->fecha = '13/06/2018';
                
                $tarea3 = new Tarea();
                $tarea3->descripcion = 'tarea 3';
                $tarea3->asignatura = 'asignatura';
                $tarea3->fecha = 'fecha';

                $tareas = array($tarea1, $tarea2, $tarea3);
                break;
            case 16:
                $tarea1 = new Tarea();
                $tarea1->descripcion = 'Examen trigonometría';
                $tarea1->asignatura = 'Matemáticas';
                $tarea1->fecha = '15/05/2018';

                $tarea2 = new Tarea();
                $tarea2->descripcion = 'Entrega de comentario de texto';
                $tarea2->asignatura = 'Literatura';
                $tarea2->fecha = '17/05/2018';

                $tarea3 = new Tarea();
                $tarea3->descripcion = 'tarea 3';
                $tarea3->asignatura = 'asignatura';
                $tarea3->fecha = 'fecha';

                $tareas = array($tarea1, $tarea2, $tarea3);
                break;
        }
        /* Simulator End */

        return $tareas;
    }

    public function getAllCursos() {

        /* CutreCurso Simulator 5.0 */
        $curso1 = new Curso();
        $curso1->id_curso = 1;
        $curso1->nombre_curso = '1º DAW';

        $curso2 = new Curso();
        $curso2->id_curso = 2;
        $curso2->nombre_curso = '2º DAW';

        $curso16 = new Curso();
        $curso16->id_curso = 16;
        $curso16->nombre_curso = '1º ESO';

        $cursos = array($curso1, $curso2, $curso16);
        /* Simulator End */

        return $cursos;
    }

    public function getNombreCurso($curso) {
        /* DameNombreDeCurso Simulator 5.0 */
        switch ($curso) {
            case 1:
                $nombre_curso = '1º DAW';
                break;
            case 2:
                $nombre_curso = '2º DAW';
                break;
            case 16:
                $nombre_curso = '1º ESO';
                break;
        }
        /* Simulator End */
        
        return $nombre_curso;
    }

}
