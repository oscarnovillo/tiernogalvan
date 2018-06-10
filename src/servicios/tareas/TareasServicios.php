<?php

namespace servicios\tareas;

use dao\tareas\TareasDAO;

class TareasServicios {

    public function getTareasFromCurso($curso, $order, $desc, $limit, $offset, $hide_old) {
        $dao = new TareasDAO();
        return $dao->getTareasFromCurso($curso, $order, $desc, $limit, $offset, $hide_old);
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

    public function updateTarea($id, $descripcion, $asignatura, $fecha) {
        $dao = new TareasDAO();
        return $dao->updateTarea($id, $descripcion, $asignatura, $fecha);
    }

    public function deleteTarea($id) {
        $dao = new TareasDAO();
        return $dao->deleteTarea($id);
    }

    public function crearTarea($id_curso, $descripcion, $asignatura, $fecha) {
        $dao = new TareasDAO();
        return $dao->crearTarea($id_curso, $descripcion, $asignatura, $fecha);
    }

    public function getTareasCountFromCurso($id_curso, $hide_old) {
        if ($hide_old == 1) {
            $hide_old = 1;
        } else {
            $hide_old = 0;
        }

        $dao = new TareasDAO();
        return $dao->getTareasCountFromCurso($id_curso, $hide_old);
    }

    public function readBool($param_name, $default) {
        $param = $default;
        if (isset($_REQUEST[$param_name])) {
            if ($_REQUEST[$param_name] == 1) {
                $param = 1;
            } else {
                $param = 0;
            }
        }
        return $param;
    }

    public function readPositivo($param_name, $default, $min, $max) {
        $param = $default;

        if (isset($_REQUEST[$param_name]) and is_numeric($_REQUEST[$param_name]) and $_REQUEST[$param_name] > $min) {
            if ($_REQUEST[$param_name] > $max) {
                $param = $max;
            } else {
                $param = intval($_REQUEST[$param_name]);
            }
        }

        return $param;
    }
}
