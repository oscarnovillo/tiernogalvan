<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace dao\seguimientoProgramaciones;
/**
 * Description of crudUnidadesTrabajo
 *
 * @author Sergio
 */
use utils\seguimientoProgramaciones\ConstantesBD;
use dao\DBConnection;
use utils\seguimientoProgramaciones\constantesMensajes;
use PDO;
class crudUnidadesTrabajo {
    public function crear_unidad_trabajo($unidad_trabajo_crear){
        $mensaje = new \stdClass;
        $unidad_trabajo_crear->hecho = 0;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        try{
            if ($this->comprobar_unidad_trabajo($unidad_trabajo_crear)==0){
                $conn->beginTransaction();
                $stmt = $conn->prepare(ConstantesBD::insert_tema);
                $stmt->bindParam(1, $unidad_trabajo_crear->nombre);
                $stmt->bindParam(2, $unidad_trabajo_crear->evaluacion);
                $stmt->bindParam(3, $unidad_trabajo_crear->hecho);
                $stmt->execute();
                $last_tema = $conn->lastInsertId();
                $stmt = $conn->prepare(ConstantesBD::asociar_tema_asignatura);
                $stmt->bindParam(1, $unidad_trabajo_crear->id_asignatura);
                $stmt->bindParam(2, $last_tema);
                $stmt->execute();
                $conn->commit();
                $mensaje->exito = constantesMensajes::INSERCION_HECHA_TEMA;
            }
            else{
                $mensaje->error = constantesMensajes::ERROR_UNIDAD_DUPLICADA;
            }
        }catch(\Exception $ex){
            if ($conn != null){
                $conn->rollback();
            }
            $mensaje->error = constantesMensajes::ERROR_GENERAL;
            echo json_encode($mensaje);
        }finally{
            $connectionDB->disconnect();
        }
        return json_encode($mensaje);
    }
    public function leer_unidad_trabajo(){
        try{
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        $stmt = $conn->prepare(ConstantesBD::select_all_unidTrabajo);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt->execute();
        $unidades_trabajo = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $unidades_trabajo;
        }catch(\Exception $ex){
        }finally{
            $connectionDB->disconnect();
        }
    }
    public function modificar_unidad_trabajo($unidad_trabajo){
        $asignaturaObjeto = new \stdClass;
        $mensaje = new \stdClass;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare(ConstantesBD::update_unidad);
            $stmt->bindParam(1, $unidad_trabajo->nombre);
            $stmt->bindParam(2, $unidad_trabajo->evaluacion);
            $stmt->bindParam(2, $unidad_trabajo->id);
            $stmt->execute();
            $stmt = $conn->prepare(ConstantesBD::update_unidad_asignatura);
            $stmt->bindParam(1, $unidad_trabajo->id_asignatura);
            $stmt->bindParam(2, $unidad_trabajo->id);
            $stmt->execute();
            $conn->commit();
            $mensaje->exito = constantesMensajes::ACTUALIZACION_HECHA;
        } catch (\Exception $ex) {
            $conn->rollback();
            $mensaje->error = constantesMensajes::ERROR_GENERAL;
            echo json_encode($mensaje);
        } finally {
            $connectionDB->disconnect();
        }
        return json_encode($mensaje);
    }
    public function borrar_unidad_trabajo($unidad_trabajo){
        $asignaturaObjeto = new \stdClass;
        $mensaje = new \stdClass;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare(ConstantesBD::borrar_unidad_asignatura);
            $stmt->bindParam(1, $unidad_trabajo->id_asignatura);
            $stmt->execute();
            $stmt = $conn->prepare(ConstantesBD::borrar_unidad);
            $stmt->bindParam(1, $unidad_trabajo->id_asignatura);
            $stmt->execute();
            $conn->commit();
            $mensaje->exito = constantesMensajes::BORRADO_HECHO;
        } catch (\Exception $ex) {
            if (strstr($ex, 'Foreign Key')) {
                $conn->rollback();
                $mensaje->error = constantesMensajes::BORRADO_FORZADO_MENSAJE;
                $mensaje->id = $unidad_trabajo->id_asignatura;
            } else {
                $conn->rollback();
                $mensaje->error = constantesMensajes::ERROR_GENERAL;
            }
            $mensaje->error = constantesMensajes::ERROR_GENERAL;
            echo json_encode($mensaje);
        } finally {
            $connectionDB->disconnect();
        }
        return json_encode($mensaje);
    }
    public function get_unidades_por_asignatura($id_asignatura){
        $asignaturaObjeto = new \stdClass;
        $mensaje = new \stdClass;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        try {
            $stmt = $conn->prepare(ConstantesBD::get_unidades_asignatura);
            $stmt->bindParam(1, $id_asignatura);
            $stmt->execute();
            $unidades_trabajo = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (\Exception $ex) {
            $mensaje->error = constantesMensajes::ERROR_GENERAL;
            echo json_encode($mensaje);
        } finally {
            $connectionDB->disconnect();
        }
        return $unidades_trabajo;
    }
    public function modificar_estado_tema($unidad_trabajo_modificar){
        $objetoUnidad = new \stdClass;
        $mensaje = new \stdClass;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        $estado = 0;
        try {
            if ($unidad_trabajo_modificar->estado == "true"){
                $estado = 1;
            }
            $stmt = $conn->prepare(ConstantesBD::modificar_estado_tema);
            $stmt->bindParam(1, $estado);
            $stmt->bindParam(2, $unidad_trabajo_modificar->id);
            $stmt->execute();
            $mensaje->exito = constantesMensajes::ESTADO_TEMA_MODIFICADO_EXITO;
        } catch (\Exception $ex) {
            $mensaje->error = constantesMensajes::ERROR_GENERAL;
            echo json_encode($mensaje);
        } finally {
            $connectionDB->disconnect();
        }
        return json_encode($mensaje);
    }
    public function comprobar_unidad_trabajo($unidTrabajo_comprobar){
        $mensaje = new \stdClass;
        $cuenta_columnas = "";
        try{
            $connectionDB = new DBConnection();
            $conn = $connectionDB->getConnection();
            $result = $conn->prepare(ConstantesBD::ID_TEMAS_MISMO_NOMBRE); 
            $result->bindParam(1, $unidTrabajo_comprobar->nombre);
            $result->execute(); 
            $id_curso = $result->fetchColumn();
            if ($id_curso != ""){
                $result = $conn->prepare(ConstantesBD::comprobar_unidad_asignatura); 
                $result->bindParam(1, $unidTrabajo_comprobar->id_asignatura);
                $result->bindParam(2, $id_curso);
                $result->execute(); 
                $cuenta_columnas=$result->fetchColumn(); 
            }
            return $cuenta_columnas;
        } catch (Exception $ex) {
            $mensaje->error = constantesMensajes::ERROR_GENERAL;
            echo json_encode($mensaje);
        }
    }
}
