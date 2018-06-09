<?php

namespace controllers;

use utils\Constantes;
use utils\tareas\ConstantesTareas;
use servicios\tareas\TareasServicios;
use servicios\tareas\TareasTextosServicios;
use servicios\session\SessionServicios;
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
        $tareasTextosServicios = new TareasTextosServicios();
        $tareasServicios = new TareasServicios();



        /* Cargar textos */
        /* Pequeño easter egg en el que si pones &idioma=en, sale todo en inglés */
        if (isset($_REQUEST["idioma"])) {
            $idioma = $_REQUEST["idioma"];
        } else {
            $idioma = "es";
        }

        $parameters["textos"] = $tareasTextosServicios->getTextos($idioma);
        /* Fin cargar textos */

        /* Comprobar permisos */
        $session = new SessionServicios();
        $id_rol = $_SESSION[Constantes::SESS_USER]->id_rol;

        $permiso_edicion = 0;
        if ($id_rol == Constantes::ID_ROL_PROFESOR || $id_rol == Constantes::ID_ROL_ADMIN) {
            $permiso_edicion = 1;
        }
        $parameters["permiso_edicion"] = $permiso_edicion;

        
        $cargarListaCursos = true;
        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];

            switch ($action) {
                /* Ver las tareas de un curso */
                case ConstantesTareas::ACTION_VER_CURSO:
                    //¿Qué curso? -> Comprobar segundo parámetro
                    if (isset($_REQUEST[ConstantesTareas::ACTION_ID_CURSO])) {
                        $cargarListaCursos = false;
                        $curso = $_REQUEST[ConstantesTareas::ACTION_ID_CURSO];

                        /* Recoger valores */
                        $order = $tareasServicios->readPositivo("order", 5, 0, 6);
                        $desc = $tareasServicios->readBool("desc", 0);
                        $hide_old = $tareasServicios->readBool("hide_old", 1);
                        $limit = $tareasServicios->readPositivo("limit", 5, 0, 100);
                        $tareas_count = $tareasServicios->getTareasCountFromCurso($curso, $hide_old);
                        $num_pag = ceil($tareas_count / $limit);
                        $pag = $tareasServicios->readPositivo("pag", 1, 0, $num_pag);
                        $offset = ($pag - 1) * $limit;


                        /* Asignar valores a parámetros para vista */
                        $parameters["tareas"] = $tareasServicios->getTareasFromCurso($curso, $order, $desc, $limit, $offset, $hide_old);
                        $parameters["id_curso"] = $curso;
                        $parameters["nombre_curso"] = $tareasServicios->getNombreCurso($curso);
                        $parameters["asignaturas"] = $tareasServicios->getAsignaturasCurso($curso);
                        $parameters["order"] = $order;
                        $parameters["desc"] = $desc;
                        $parameters["hide_old"] = $hide_old;
                        $parameters["limit"] = $limit;
                        $parameters["offset"] = $offset;
                        $parameters["pag"] = $pag;
                        $parameters["num_pag"] = $num_pag;
                        $parameters["tareas_count"] = $tareas_count;

                        if (isset($_POST["recarga"])) { //Recargar sólo la tabla
                            $page = ConstantesTareas::TABLA_TAREAS_PAGE;
                        } else {
                            $page = ConstantesTareas::MOSTRAR_TAREAS_PAGE;
                        }
                    }
                    break;
                case ConstantesTareas::ACTION_MODIFICAR_TAREA:
                    if ($parameters["permiso_edicion"] = 1) {
                        $cargarListaCursos = false;
                        $id = $_POST["id"];
                        $descripcion = $_POST["descripcion"];
                        $asignatura = $_POST["asignatura"];
                        $fecha = $_POST["fecha"];

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
                    }
                    break;
                case ConstantesTareas::ACTION_BORRAR_TAREA:
                    if ($parameters["permiso_edicion"] = 1) {
                        $cargarListaCursos = false;
                        $id = $_POST["id"];

                        if (isset($id)) {
                            if ($tareasServicios->deleteTarea($id) > 0) {
                                http_response_code(200);
                            } else {
                                http_response_code(501);
                            }
                        } else {
                            http_response_code(501);
                        }
                    }
                    break;
                case ConstantesTareas::ACTION_CREAR_TAREA:
                    if ($parameters["permiso_edicion"] = 1) {
                        $cargarListaCursos = false;
                        $id_curso = $_POST["id_curso"];
                        $descripcion = $_POST["descripcion"];
                        $asignatura = $_POST["asignatura"];
                        $fecha = $_POST["fecha"];

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
                    }
                    break;
            }
        }

        if ($cargarListaCursos) {
            //Obtener lista de cursos (opción por defecto si no encuentra los parámetros adecuados)
            $page = ConstantesTareas::MOSTRAR_CURSOS_PAGE;
            $parameters["cursos"] = $tareasServicios->getAllCursos();
            $parameters["action_ver_curso"] = ConstantesTareas::ACTION_VER_CURSO;
        }

        //Pintar una pagina de twig
        TwigViewer::getInstance()->viewPage($page, $parameters);
    }

}
