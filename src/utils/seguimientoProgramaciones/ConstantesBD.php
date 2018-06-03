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
    const actualizar_asignatura = "UPDATE ASIGNATURAS SET nombre = ? WHERE id = ?";
}
