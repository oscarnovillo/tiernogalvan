<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace utils\seguimientoProgramaciones;
/**
 * Description of ConstantesBD
 *
 * @author Sergio
 */
class ConstantesBD {
    const select_all_asignaturas = "SELECT * FROM ASIGNATURAS";
    const select_all_unidTrabajo = "SELECT * FROM UNIDADES_TRABAJO";
    const insert_asignatura = "INSERT INTO ASIGNATURAS (NOMBRE) VALUES(?)";
    const insert_tema = "INSERT INTO UNIDADES_TRABAJO(NOMBRE,EVALUACION, UNIDAD_HECHA) VALUES(?,?,?)";
    const asociar_tema_asignatura = "INSERT INTO ASIGNATURA_UNIDADTRABAJO (ID_ASIGNATURA, ID_UNIDAD_TRABAJO) VALUES (?,?)";
    const actualizar_asignatura = "UPDATE ASIGNATURAS SET nombre = ? WHERE id = ?";
    const insert_unidad = "INSERT INTO ASIGNATURAS (NOMBRE) VALUES(?)";
    const actualizar_unidad = "UPDATE UNIDADES_TRABAJO SET nombre = ? WHERE id = ?";
    const CONTAR_ASIGNATURAS_MISMO_NOMBRE = "SELECT count(*) FROM ASIGNATURAS WHERE NOMBRE = ?";
    const ID_TEMAS_MISMO_NOMBRE = "SELECT id FROM UNIDADES_TRABAJO WHERE NOMBRE = ?";
    const GET_ALL_CURSOS = "SELECT * FROM cursos";
    const insert_curso_asignatura = "INSERT INTO CURSOS_ASIGNATURAS (ID_ASIGNATURA,ID_CURSO) VALUES(?,?)";
    const get_asignaturas_curso = "SELECT * FROM asignaturas where id IN (SELECT ID_ASIGNATURA FROM cursos_asignaturas where ID_CURSO=?)";
    const comprobar_unidad_asignatura = "SELECT COUNT(*) FROM ASIGNATURA_UNIDADTRABAJO WHERE ID_ASIGNATURA = ? AND ID_UNIDAD_TRABAJO = ?";
    const get_curso_asignatura = "select id_curso, nombre_curso from cursos where id_curso in (SELECT id_curso from cursos_asignaturas where id_asignatura = ?)";
    const update_asignatura_curso = "UPDATE CURSOS_ASIGNATURAS SET ID_CURSO = ? WHERE ID_ASIGNATURA = ?";
    const borrar_asignatura = "DELETE FROM ASIGNATURAS WHERE ID = ?";
    const borrar_asignatura_curso = "DELETE FROM CURSOS_ASIGNATURAS WHERE ID_ASIGNATURA = ?";
    const update_unidad = "UPDATE UNIDADES_TRABAJO SET NOMBRE = ?,EVALUACION=?,COMENTARIO=? WHERE ID = ?";
    const update_unidad_asignatura = "UPDATE ASIGNATURA_UNIDADTRABAJO SET ID_ASIGNATURA = ? WHERE ID_UNIDAD_TRABAJO = ?";
    const borrar_unidad = "DELETE FROM UNIDADES_TRABAJO WHERE ID = ?";
    const borrar_unidad_asignatura = "DELETE FROM ASIGNATURA_UNIDADTRABAJO WHERE ID_UNIDAD_TRABAJO = ?";
    const borrar_asignatura_unidad = "DELETE FROM ASIGNATURA_UNIDADTRABAJO WHERE ID_ASIGNATURA = ?";
    const get_unidades_asignatura = "SELECT * FROM unidades_trabajo where unidades_trabajo.ID IN (SELECT ID_UNIDAD_TRABAJO FROM asignatura_unidadtrabajo where ID_ASIGNATURA=?)";
    const modificar_estado_tema = "UPDATE UNIDADES_TRABAJO SET UNIDAD_HECHA = ? WHERE ID  = ?";
}
