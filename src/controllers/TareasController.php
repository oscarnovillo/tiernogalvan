<?php

namespace controllers;

use utils\Constantes;
use utils\tareas\ConstantesTareas;
use servicios\tareas\TareasServicios;
use utils\TwigViewer;

class TareasController {

    public function tareas() {

        /*
         * VER TAREAS DE ALUMNOS
         * 
         * Objetivos:
         * 
         * Si no hay parámetros puestos:
         * -> Mostrar un listado con todos los cursos disponibles.
         * 
         * Al hacer click en un curso si eres alumno
         * -> Mostrar las tareas de dicho curso
         * 
         * Al hacer click en un curso si eres profesor:
         * -> Opciones de CRUD de las tareas de dicho curso
         * 
         * Si eres administrador:
         * -> Crear curso nuevo. ¿Editar y borrar también?
         */


        $parameters = array();

        //Obtener lista de cursos (opción por defecto si no encuentra los parámetros adecuados)
        $page = ConstantesTareas::MOSTRAR_CURSOS_PAGE;

        $tareasServicios = new TareasServicios();
        $parameters["cursos"] = $tareasServicios->getAllCursos();

        $parameters["action_ver_curso"] = ConstantesTareas::ACTION_VER_CURSO;

        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];

            switch ($action) {
                /* Ver las tareas de un curso */
                case ConstantesTareas::ACTION_VER_CURSO:
                    //¿Qué curso? -> Comprobar segundo parámetro
                    if (isset($_REQUEST[ConstantesTareas::ACTION_ID_CURSO])) {
                        $curso = $_REQUEST[ConstantesTareas::ACTION_ID_CURSO];

                        $tareasServicios = new TareasServicios();
                        $parameters["tareas"] = $tareasServicios->getAllTareasFromCurso($curso);
                        $parameters["id_curso"] = $curso;
                        $parameters["nombre_curso"] = $tareasServicios->getNombreCurso($curso);
                        $parameters["asignaturas"] = $tareasServicios->getAsignaturasCurso($curso);
                        
                        //TODO/PRUEBAS: Como no hay permisos aún, para hacer pruebas he añadido un parámetro que si es true, entras con permiso de profesor.
                        //Evidentemente esto hay que cambiarlo luego.
                        $parameters["tienes_permisos"] = $_REQUEST["hola_tengo_permisos_de_profesor"];
                        
                        $parameters["editarTareaOk"] = ConstantesTareas::EDITAR_TAREA_OK;
                        $parameters["editarTareaOkTooltip"] = ConstantesTareas::EDITAR_TAREA_OK_TOOLTIP;
                        $parameters["editarTareaCancelar"] = ConstantesTareas::EDITAR_TAREA_CANCELAR;
                        $parameters["editarTareaCancelarTooltip"] = ConstantesTareas::EDITAR_TAREA_CANCELAR_TOOLTIP;
                        $parameters["editarTareaEditar"] = ConstantesTareas::EDITAR_TAREA_EDITAR;
                        $parameters["editarTareaEditarTooltip"] = ConstantesTareas::EDITAR_TAREA_EDITAR_TOOLTIP;
                        $parameters["editarTareaBorrar"] = ConstantesTareas::EDITAR_TAREA_BORRAR;
                        $parameters["editarTareaBorrarTooltip"] = ConstantesTareas::EDITAR_TAREA_BORRAR_TOOLTIP;

                        $page = ConstantesTareas::MOSTRAR_TAREAS_PAGE;
                    }
                    break;
                case "modificar_tarea":
                    //TODO: Aumentar la seguridad comprobando que verdaderamente tienes permiso para editar y no has pillado la url en plan hacker.
                    $id = $_REQUEST["id"];
                    $descripcion = $_REQUEST["descripcion"];
                    $asignatura = $_REQUEST["asignatura"];
                    $fecha = $_REQUEST["fecha"];

                    if (isset($id) &&
                            isset($descripcion) &&
                            isset($asignatura) &&
                            isset($fecha)) {
                        if ($tareasServicios->updateTarea($id, $descripcion, $asignatura, $fecha) > 0) {
                            http_response_code(200);
                        } else {
                            http_response_code(501);
                        }
                    } else {
                        http_response_code(501);
                    }
                    break;
                case "borrar_tarea":
                    //TODO: Aumentar la seguridad
                    $id = $_REQUEST["id"];

                    if (isset($id)) {
                        if ($tareasServicios->deleteTarea($id) > 0) {
                            http_response_code(200);
                        } else {
                            http_response_code(501);
                        }
                    } else {
                        http_response_code(501);
                    }
                    break;
                case "crear_tarea":
                    //TODO: Aumentar la seguridad
                    $id_curso = $_REQUEST["id_curso"];
                    $descripcion = $_REQUEST["descripcion"];
                    $asignatura = $_REQUEST["asignatura"];
                    $fecha = $_REQUEST["fecha"];

                    if (isset($id_curso) &&
                            isset($descripcion) &&
                            isset($asignatura) &&
                            isset($fecha)) {
                        if ($tareasServicios->crearTarea($id_curso, $descripcion, $asignatura, $fecha) > 0) {
                            http_response_code(200);
                        } else {
                            http_response_code(501);
                        }
                    } else {
                        http_response_code(501);
                    }
                    break;
            }
        }

        //Pintar una pagina de twig
        TwigViewer::getInstance()->viewPage($page, $parameters);
    }

}
