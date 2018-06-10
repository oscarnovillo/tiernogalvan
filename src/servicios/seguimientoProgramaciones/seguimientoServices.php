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
use dao\seguimientoProgramaciones\cursoDAO;
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
    public function borrado_total($asignatura){
        $dao = new crudAsignaturas();
        return $dao->borrado_total($asignatura);
    }
    public function leer_asignatura(){
        $dao = new crudAsignaturas();
        return $dao->get_all_asignaturas();
    }
    
    public function get_asignaturas_curso($id_curso){
        $dao = new crudAsignaturas();
        return $dao->get_asignaturas_curso($id_curso);
    }
    public function insertar_unidad_trabajo($unidad_trabajo){
        $dao = new crudUnidadesTrabajo();
        return $dao->crear_unidad_trabajo($unidad_trabajo);
    }
    public function get_cursos_asignaturas($id_asignatura){
       $dao = new cursoDAO();
       return $dao->get_curso_asignatura($id_asignatura);
    }
    public function modificar_unidad_trabajo($unidad_trabajo){
        $dao = new crudUnidadesTrabajo();
        return $dao->modificar_unidad_trabajo($unidad_trabajo);
    }
    public function borrar_unidad_trabajo($unidad_trabajo){
        $dao = new crudUnidadesTrabajo();
        return $dao->borrar_asignatura($unidad_trabajo);
    }
    public function leer_unidad_trabajo(){
        $dao = new crudUnidadesTrabajo();
        return $dao->get_all_asignaturas();
    }
    public function get_unidad_asignatura($id_asignatura){
        $dao = new crudUnidadesTrabajo();
        return $dao->get_unidades_por_asignatura($id_asignatura);
    }
    public function modificar_estado_tema($unidad_trabajo){
        $dao = new crudUnidadesTrabajo();
        return $dao->modificar_estado_tema($unidad_trabajo);
    }
    public function leer_cursos(){
        $dao = new cursoDAO();
        return $dao->get_all_cursos();
    }
}
