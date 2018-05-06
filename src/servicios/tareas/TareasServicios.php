<?php
namespace servicios\tareas;

use dao\tareas\TareasDAO;

class TareasServicios {

    public function getAllTareasFromCurso($curso) {
        $dao = new TareasDAO();
        return $dao->getAllTareasFromCurso($curso);
    }
    
    public function getAllCursos() {
        $dao = new TareasDAO();
        return $dao->getAllCursos();
    }

    public function getNombreCurso($curso) {
        $dao = new TareasDAO();
        return $dao->getNombreCurso($curso);
    }

    public function getAsignaturasCurso($curso) {
        $dao = new TareasDAO();
        return $dao->getAsignaturasCurso($curso);
    }
}
