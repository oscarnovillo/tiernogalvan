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
use PDO;

class crudAsignaturas {

    public function crear_asignatura($asignatura_crear) {
        $asignaturaObjeto = new \stdClass;
        $mensaje = new \stdClass;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        try {
            if ($this->comprobar_asignatura($asignatura_crear) == 0) {
                $conn->beginTransaction();
                $stmt = $conn->prepare(ConstantesBD::insert_asignatura);
                $stmt->bindParam(1, $asignatura_crear->nombre);
                $stmt->execute();
                $last_asignatura = $conn->lastInsertId();
                $asignaturaObjeto->id = $last_asignatura;
                $stmt = $conn->prepare(ConstantesBD::insert_curso_asignatura);
                $stmt->bindParam(1, $last_asignatura);
                $stmt->bindParam(2, $asignatura_crear->id_curso);
                $stmt->execute();
                $conn->commit();
                $mensaje->exito = constantesMensajes::INSERCION_HECHA;
            } else {
                $mensaje->error = constantesMensajes::ERROR_ASIGNATURA_DUPLICADA;
            }
        } catch (\Exception $ex) {
            $conn->rollback();
            if (strstr($ex, 'Duplicate entry')) {
                $conn->rollback();
                $mensaje->error = constantesMensajes::ERROR_ASIGNATURA_DUPLICADA;
            } else {
                $conn->rollback();
                $mensaje->error = constantesMensajes::ERROR_GENERAL;
            }
            echo json_encode($mensaje);
        } finally {
            $connectionDB->disconnect();
        }
        return json_encode($mensaje);
    }

    public function get_all_asignaturas() {
        $mensaje = new \stdClass;
        try{
            $connectionDB = new DBConnection();
            $conn = $connectionDB->getConnection();
            $stmt = $conn->prepare(ConstantesBD::select_all_asignaturas);
            $stmt->execute();
            $asignaturas = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $asignaturas;
        } catch (Exception $ex) {

        }finally{
            $connectionDB->disconnect();
        }
    }

    public function modificar_asignatura($asignatura_modificar) {
        $asignaturaObjeto = new \stdClass;
        $mensaje = new \stdClass;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare(ConstantesBD::actualizar_asignatura);
            $stmt->bindParam(1, $asignatura_modificar->nombre);
            $stmt->bindParam(2, $asignatura_modificar->id_asignatura);
            $stmt->execute();
            $stmt = $conn->prepare(ConstantesBD::update_asignatura_curso);
            $stmt->bindParam(1, $asignatura_modificar->id_curso);
            $stmt->bindParam(2, $asignatura_modificar->id_asignatura);
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

    public function get_asignaturas_curso($id_curso) {
        $mensaje = new \stdClass;
        try{
            $connectionDB = new DBConnection();
            $conn = $connectionDB->getConnection();
            $stmt = $conn->prepare(ConstantesBD::get_asignaturas_curso);
            $stmt->bindParam(1, $id_curso);
            $stmt->execute();
            $asignaturas = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $asignaturas;
        } catch (Exception $ex) {
        } finally{
            $connectionDB->disconnect();
        }
    }

    public function borrar_asignatura($asignatura_borrar) {
        $asignaturaObjeto = new \stdClass;
        $mensaje = new \stdClass;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        try {/*
            $conn->beginTransaction();
            $stmt = $conn->prepare(ConstantesBD::borrar_asignatura_curso);
            $stmt->bindParam(1, $asignatura_borrar->id_asignatura);
            $stmt->execute();*/
            $stmt = $conn->prepare(ConstantesBD::borrar_asignatura);
            $stmt->bindParam(1, $asignatura_borrar->id_asignatura);
            $stmt->execute();
            //$conn->commit();
            $mensaje->exito = constantesMensajes::BORRADO_HECHO;
        } catch (\Exception $ex) {
            if (strstr($ex->getMessage(), 'a foreign key')) {
                //$conn->rollback();
                $mensaje->ferror = constantesMensajes::BORRADO_FORZADO_MENSAJE;
                $mensaje->id = $asignatura_borrar->id_asignatura;
            } else {
                //$conn->rollback();
                $mensaje->error = constantesMensajes::ERROR_GENERAL;
            }
        } finally {
            $connectionDB->disconnect();
        }
        return json_encode($mensaje);
    }
    public function borrado_total($asignatura_borrar){
        $asignaturaObjeto = new \stdClass;
        $mensaje = new \stdClass;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare(ConstantesBD::borrar_asignatura_unidad);
            $stmt->bindParam(1, $asignatura_borrar->id_asignatura);
            $stmt->execute();
            $stmt = $conn->prepare(ConstantesBD::borrar_asignatura_curso);
            $stmt->bindParam(1, $asignatura_borrar->id_asignatura);
            $stmt->execute();
            $stmt = $conn->prepare(ConstantesBD::borrar_asignatura);
            $stmt->bindParam(1, $asignatura_borrar->id_asignatura);
            $stmt->execute();
            $conn->commit();
            $mensaje->exito = constantesMensajes::BORRADO_HECHO;
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            $mensaje->error = constantesMensajes::ERROR_GENERAL;
        } finally {
            $connectionDB->disconnect();
        }
        return json_encode($mensaje);
    }
    public function comprobar_asignatura($asignatura_comprobar) {
        $mensaje = new \stdClass;
        try {
            $connectionDB = new DBConnection();
            $conn = $connectionDB->getConnection();
            $result = $conn->prepare(ConstantesBD::CONTAR_ASIGNATURAS_MISMO_NOMBRE);
            $result->bindParam(1, $asignatura_comprobar->nombre);
            $result->execute();
            $number_of_rows = $result->fetchColumn();
            return $number_of_rows;
        } catch (Exception $ex) {
            $mensaje->error = constantesMensajes::ERROR_GENERAL;
            echo json_encode($mensaje);
        } finally{
            $connectionDB->disconnect();
        }
    }

}
