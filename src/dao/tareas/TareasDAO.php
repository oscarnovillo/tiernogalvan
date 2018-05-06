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
        $dbConnection = new DBConnection();

//        $sql =  "SELECT * FROM cursos".
//          " Order By Case tipo".
//              " When 'ESO' Then 1".
//              " When 'BACH' Then 2".
//              " When 'FPB' Then 3".
//              " When 'FPGM' Then 4".
//              " When 'FPGS' Then 5".
//              " Else 6 End;";
//        
//        $db = $dbConnection->getConnection();
//        $stmt = $db->prepare($sql);
//        $stmt->execute();
//        $cursos = $stmt->fetchAll(PDO::FETCH_OBJ);
//        $dbConnection->disconnect();
        
        /* CutreCurso Simulator 5.0 */

        $curso1 = new Curso;
        $curso1->id_curso = 1;
        $curso1->nombre_curso = '1º E.S.O.';
        $curso1->tipo = 'ESO';
        $curso1->turno = '';

        $curso2 = new Curso;
        $curso2->id_curso = 2;
        $curso2->nombre_curso = '2º E.S.O.';
        $curso2->tipo = 'ESO';
        $curso2->turno = '';

        $curso3 = new Curso;
        $curso3->id_curso = 3;
        $curso3->nombre_curso = '3º E.S.O.';
        $curso3->tipo = 'ESO';
        $curso3->turno = '';

        $curso4 = new Curso;
        $curso4->id_curso = 4;
        $curso4->nombre_curso = '4º E.S.O.';
        $curso4->tipo = 'ESO';
        $curso4->turno = '';

        $curso5 = new Curso;
        $curso5->id_curso = 5;
        $curso5->nombre_curso = '1º Bachillerato';
        $curso5->tipo = 'BACH';
        $curso5->turno = '';

        $curso6 = new Curso;
        $curso6->id_curso = 6;
        $curso6->nombre_curso = '2º Bachillerato';
        $curso6->tipo = 'BACH';
        $curso6->turno = '';

        $curso7 = new Curso;
        $curso7->id_curso = 7;
        $curso7->nombre_curso = '1º Mantenimiento de vehículos';
        $curso7->tipo = 'FPB';
        $curso7->turno = 'm';

        $curso8 = new Curso;
        $curso8->id_curso = 8;
        $curso8->nombre_curso = '2º Mantenimiento de vehículos';
        $curso8->tipo = 'FPB';
        $curso8->turno = 'm';

        $curso9 = new Curso;
        $curso9->id_curso = 9;
        $curso9->nombre_curso = '1º Mantenimiento de vehículos';
        $curso9->tipo = 'FPB';
        $curso9->turno = 't';

        $curso10 = new Curso;
        $curso10->id_curso = 10;
        $curso10->nombre_curso = '2º Mantenimiento de vehículos';
        $curso10->tipo = 'FPB';
        $curso10->turno = 't';

        $curso11 = new Curso;
        $curso11->id_curso = 11;
        $curso11->nombre_curso = '1º Carrocería';
        $curso11->tipo = 'FPGM';
        $curso11->turno = 'm';

        $curso12 = new Curso;
        $curso12->id_curso = 12;
        $curso12->nombre_curso = '2º Carrocería';
        $curso12->tipo = 'FPGM';
        $curso12->turno = 'm';

        $curso13 = new Curso;
        $curso13->id_curso = 13;
        $curso13->nombre_curso = '1º Instalaciones Eléctricas y Automáticas';
        $curso13->tipo = 'FPGM';
        $curso13->turno = 'm';

        $curso14 = new Curso;
        $curso14->id_curso = 14;
        $curso14->nombre_curso = '2º Instalaciones Eléctricas y Automáticas';
        $curso14->tipo = 'FPGM';
        $curso14->turno = 'm';

        $curso15 = new Curso;
        $curso15->id_curso = 15;
        $curso15->nombre_curso = '1º Instalaciones de Producción de Calor, Frigoríficas y de Climatización';
        $curso15->tipo = 'FPGM';
        $curso15->turno = '';

        $curso16 = new Curso;
        $curso16->id_curso = 16;
        $curso16->nombre_curso = '2º Instalaciones de Producción de Calor, Frigoríficas y de Climatización';
        $curso16->tipo = 'FPGM';
        $curso16->turno = 'm';

        $curso17 = new Curso;
        $curso17->id_curso = 17;
        $curso17->nombre_curso = '1º ASIR';
        $curso17->tipo = 'FPGS';
        $curso17->turno = 't';

        $curso18 = new Curso;
        $curso18->id_curso = 18;
        $curso18->nombre_curso = '2º ASIR';
        $curso18->tipo = 'FPGS';
        $curso18->turno = 't';

        $curso19 = new Curso;
        $curso19->id_curso = 19;
        $curso19->nombre_curso = '1º Mantenimiento de Instalaciones Térmicas y Fluidos';
        $curso19->tipo = 'FPGS';
        $curso19->turno = 't';

        $curso20 = new Curso;
        $curso20->id_curso = 20;
        $curso20->nombre_curso = '2º Mantenimiento de Instalaciones Térmicas y Fluidos';
        $curso20->tipo = 'FPGS';
        $curso20->turno = 't';

        $curso21 = new Curso;
        $curso21->id_curso = 21;
        $curso21->nombre_curso = '1º Automoción';
        $curso21->tipo = 'FPGS';
        $curso21->turno = 't';

        $curso22 = new Curso;
        $curso22->id_curso = 22;
        $curso22->nombre_curso = '2º Automoción';
        $curso22->tipo = 'FPGS';
        $curso22->turno = 't';

        $curso23 = new Curso;
        $curso23->id_curso = 23;
        $curso23->nombre_curso = '1º DAW';
        $curso23->tipo = 'FPGS';
        $curso23->turno = 'm';

        $curso24 = new Curso;
        $curso24->id_curso = 24;
        $curso24->nombre_curso = '2º DAW';
        $curso24->tipo = 'FPGS';
        $curso24->turno = 'm';

        $cursos = array($curso1, $curso2, $curso3, $curso4, $curso5, $curso6, $curso7, $curso8, $curso9, $curso10, $curso11, $curso12, $curso13, $curso14, $curso15, $curso16, $curso17, $curso18, $curso19, $curso20, $curso21, $curso22, $curso23, $curso24);
        /* Simulator End */

        return $cursos;
    }
    
    
    public function getAllTareasFromCurso($curso) { 
//        $sql = "SELECT *"
//                . " FROM tareas"
//                . " WHEN curso=?";
        
//        $db = $dbConnection->getConnection();
//        $stmt = $db->prepare($sql);
//        $stmt->execute();
//        $cursos = $stmt->fetchAll(PDO::FETCH_OBJ);
//        $dbConnection->disconnect();
        
        
        /* CutreTask Simulator 5.0 */
        switch ($curso) {
            case 1:
                $tarea1 = new Tarea();
                $tarea1->id_tarea = '1';
                $tarea1->descripcion = 'Examen trigonometría';
                $tarea1->asignatura = 'Matemáticas';
                $tarea1->fecha = '2018-05-15';

                $tarea2 = new Tarea();
                $tarea2->id_tarea = '2';
                $tarea2->descripcion = 'Entrega de comentario de texto';
                $tarea2->asignatura = 'Literatura';
                $tarea2->fecha = '2018-05-17';

                $tarea3 = new Tarea();
                $tarea3->id_tarea = '3';
                $tarea3->descripcion = 'tarea 3';
                $tarea3->asignatura = 'asignatura';
                $tarea3->fecha = '2018-06-13';

                $tareas = array($tarea1, $tarea2, $tarea3);
                break;
            case 23:
                $tarea1 = new Tarea();
                $tarea1->id_tarea = '1';
                $tarea1->descripcion = 'tarea 1';
                $tarea1->asignatura = 'Bases de datos';
                $tarea1->fecha = '2018-06-13';

                $tarea2 = new Tarea();
                $tarea2->id_tarea = '2';
                $tarea2->descripcion = 'tarea 2';
                $tarea2->asignatura = 'Sistemas';
                $tarea2->fecha = '2018-06-13';

                $tarea3 = new Tarea();
                $tarea3->id_tarea = '3';
                $tarea3->descripcion = 'tarea 3';
                $tarea3->asignatura = 'asignatura';
                $tarea3->fecha = '2018-06-13';

                $tareas = array($tarea1, $tarea2, $tarea3);
                break;

            case 24:
                $tarea1 = new Tarea();
                $tarea1->id_tarea = '1';
                $tarea1->descripcion = 'Guti debe quitar este DAO simulado y llamar a la BBDD';
                $tarea1->asignatura = 'PFC';
                $tarea1->fecha = '2018-06-01';

                $tarea2 = new Tarea();
                $tarea2->id_tarea = '2';
                $tarea2->descripcion = 'Entregar proyecto';
                $tarea2->asignatura = 'PFC';
                $tarea2->fecha = '2018-06-13';
                
                $tarea3 = new Tarea();
                $tarea3->id_tarea = '3';
                $tarea3->descripcion = 'tarea 3';
                $tarea3->asignatura = 'asignatura';
                $tarea3->fecha = '2018-06-13';

                $tareas = array($tarea1, $tarea2, $tarea3);
                break;

        }
        /* Simulator End */

        return $tareas;
    }

    public function getNombreCurso($curso) {
//        $sql =  "SELECT nombre_curso"
//                . " FROM cursos"
//                . " WHEN id_curso=?";
//        
//        $db = $dbConnection->getConnection();
//        $stmt = $db->prepare($sql);
//        $stmt->execute();
//        $cursos = $stmt->fetchAll(PDO::FETCH_OBJ);
//        $dbConnection->disconnect();

        /* CutreDameNombreDeCurso Simulator 5.0 */
        switch ($curso) {
            case 1:
                $nombre_curso = '1º ESO';
                break;
            case 23:
                $nombre_curso = '1º DAW';
                break;
            case 24:
                $nombre_curso = '2º DAW';
                break;
        }
        /* Simulator End */
        
        return $nombre_curso;
    }

    public function getAsignaturasCurso($curso) {
//        $sql =  "SELECT DISTINCT asignatura"
//                . " FROM tareas"
//                . " WHEN id_curso=?";
//        
//        $db = $dbConnection->getConnection();
//        $stmt = $db->prepare($sql);
//        $stmt->execute();
//        $cursos = $stmt->fetchAll(PDO::FETCH_OBJ);
//        $dbConnection->disconnect();

        
        /* CutreDameAsignaturasDeCurso Simulator 5.0 */
        switch ($curso) {
            case 1:
                $asignaturas = array('Matemáticas', 'Literatura', 'asignatura');
                break;
            case 23:
                $asignaturas = array('Bases de datos', 'Sistemas', 'asignatura');
                break;
            case 24:
                $asignaturas = array('PFC', 'asignatura');
                break;
        }
        /* Simulator End */
        
        return $asignaturas;
    }
    
}
