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
class crudUnidadesTrabajo {
    public function crear_unidad_trabajo($unidad_trabajo_crear){
        $unidad_trabajoObjeto = new \stdClass;
        $connectionDB = new DBConnection();
        $conn = $connectionDB->getConnection();
        try{
            $stmt = $conn->prepare(ConstantesBD::insert_asignatura);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->bindParam(1, $unidad_trabajo_crear->nombre);
            $stmt->execute();
        }catch(\Exception $ex){
            $error = constantesMensajes::ERROR_GENERAL;
            return $error;
        }finally{
            $connectionDB->disconnect();
        }
        $unidad_trabajoObjeto->mensaje= constantesMensajes::INSERCION_HECHA_UNIDAD;
        $unidad_trabajoObjeto->objeto = json_encode($unidad_trabajo_crear);
        $json_unidad_trabajo = json_encode($unidad_trabajoObjeto);
        return $json_unidad_trabajo;
    }
    public function leer_unidad_trabajo(){
        $stmt = $conn->prepare(ConstantesBD::select_all_unidTrabajo);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt->execute();
        $unidades_trabajo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $unidades_trabajo;
    }
    public function modificar_unidad_trabajo(){
        
    }
    public function borrar_unidad_trabajo(){
        
    }
}
