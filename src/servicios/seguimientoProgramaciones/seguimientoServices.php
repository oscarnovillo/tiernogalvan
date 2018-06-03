<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace servicios\seguimientoProgramaciones;
/**
 * Description of seguimientoServices
 *
 * @author Sergio
 */
use dao\seguimientoProgramaciones\crudAsignaturas;
use dao\seguimientoProgramaciones\crudUnidadesTrabajo;
class seguimientoServices {
    public function parseo_json($json){
        $json_parseado = json_decode($json);
        return $json_parseado;
    }
    public function insertar_asignatura($asignatura){
        $dao = new crudAsignaturas();
        return $dao->crear_asignatura($asignatura);
    }
    public function modificar_asignatura($asignatura){
        $dao = new crudAsignaturas();
        return $dao->modificar_asignatura($asignatura);
    }
    public function borrar_asignatura($asignatura){
        $dao = new crudAsignaturas();
        return $dao->borrar_asignatura($asignatura);
    }
    public function leer_asignatura(){
        $dao = new crudAsignaturas();
        return $dao->get_all_asignaturas();
    }
}
