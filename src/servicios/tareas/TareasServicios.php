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
    
    public function updateTarea($id,$descripcion,$asignatura,$fecha) {
        $dao = new TareasDAO();
        return $dao->updateTarea($id,$descripcion,$asignatura,$fecha);
    }
    
    public function deleteTarea($id) {
        $dao = new TareasDAO();
        return $dao->deleteTarea($id);
    }
    
    public function crearTarea($id_curso,$descripcion,$asignatura,$fecha) {
        $dao = new TareasDAO();
        return $dao->crearTarea($id_curso,$descripcion,$asignatura,$fecha);
    }
}
