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
        $mensaje = new \stdClass;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        try{
            if ($this->comprobar_asignatura($asignatura_crear) == 0){
                $stmt = $conn->prepare(ConstantesBD::insert_asignatura);
                $stmt->bindParam(1, $asignatura_crear->nombre);
                $stmt->execute();
                $exito = constantesMensajes::INSERCION_HECHA;
            }else{
                $mensaje->error = constantesMensajes::ERROR_ASIGNATURA_DUPLICADA;
            }
        }catch(\Exception $ex){
            if (strstr($ex, 'Duplicate entry')){
                $mensaje->error = constantesMensajes::ERROR_ASIGNATURA_DUPLICADA;
            }else{
                $mensaje->error = constantesMensajes::ERROR_GENERAL;
            }
            return json_encode($mensaje);
        }finally{
            $connectionDB->disconnect();
        }
        $asignaturaObjeto->exito= constantesMensajes::INSERCION_HECHA;
        $asignaturaObjeto->objeto = json_encode($asignatura_crear);
        $json_asignatura = json_encode($asignaturaObjeto);
        return $json_asignatura;
    }
    public function get_all_asignaturas(){
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
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
    
    public function comprobar_asignatura($asignatura_comprobar){
        
        $result = $con->prepare(ConstantesBD::CONTAR_ASIGNATURAS_MISMO_NOMBRE); 
        $stmt->bindParam(1, $asignatura_comprobar->nombre);
        $result->execute(); 
        $number_of_rows = $result->fetchColumn(); 
        return $number_of_rows;
    }
}
