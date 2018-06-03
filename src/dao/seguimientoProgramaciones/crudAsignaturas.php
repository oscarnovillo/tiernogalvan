<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace dao\seguimientoProgramaciones;
/**
 * Description of crudAsignaturas
 *
 * @author Sergio
 */
use utils\seguimientoProgramaciones\ConstantesBD;
use dao\DBConnection;
use utils\seguimientoProgramaciones\constantesMensajes;
class crudAsignaturas{
    public function crear_asignatura($asignatura_crear){
        $asignaturaObjeto = new \stdClass;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        try{
            $stmt = $conn->prepare(ConstantesBD::insert_asignatura);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->bindParam(1, $asignatura_crear->nombre);
            $stmt->execute();
            $exito = constantesMensajes::INSERCION_HECHA;
        }catch(\Exception $ex){
            $error = constantesMensajes::ERROR_GENERAL;
            return $error;
        }finally{
            $connectionDB->disconnect();
        }
        $asignaturaObjeto->mensaje= constantesMensajes::INSERCION_HECHA;
        $asignaturaObjeto->objeto = $asignatura_crear;
        $json_asignatura = json_encode($asignaturaObjeto);
        return $json_asignatura;
    }
    public function get_all_asignaturas(){
        $stmt = $conn->prepare(ConstantesBD::select_all_asignaturas);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt->execute();
        $asignaturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $asignaturas;
    }
    public function modificar_asignatura($asignatura_modificar){
        $asignaturaObjeto = new \stdClass;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        try{
            $stmt = $conn->prepare(ConstantesBD::actualizar_asignatura);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->bindParam(1, $asignatura_crear->nombre);
            $stmt->bindParam(2, $asignatura_crear->id);
            $stmt->execute();
        }catch(\Exception $ex){
            $error = constantesMensajes::ERROR_GENERAL;
            return $error;
        }finally{
            $connectionDB->disconnect();
        }
        $asignaturaObjeto->mensaje= constantesMensajes::ACTUALIZACION_HECHA;
        $asignaturaObjeto->objeto = $asignatura_crear;
        $json_asignatura = json_encode($asignaturaObjeto);
        return $json_asignatura;
    }
    public function borrar_asignatura($asignatura_borrar){
        return;
    }
}
