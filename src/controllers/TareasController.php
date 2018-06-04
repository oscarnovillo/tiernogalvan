<?php

namespace controllers;

use utils\Constantes;
use utils\tareas\ConstantesTareas;
use servicios\tareas\TareasServicios;
use servicios\tareas\TareasTextosServicios;
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

        /* Cargar textos */
        if (isset($_REQUEST["idioma"])) {
            $idioma = $_REQUEST["idioma"];
        } else {
            $idioma = "es";
        }

        $tareasTextosServicios = new TareasTextosServicios();
        $parameters["textos"] = $tareasTextosServicios->getTextos($idioma);
        /* Fin cargar textos */

        /* Permisos */
        //TODO/PRUEBAS: Como no hay permisos aún, para hacer pruebas he añadido un parámetro que si es true, entras con permiso de profesor.
        $parameters["permiso_edicion"] = 0;

        if (isset($_REQUEST["hola_tengo_permisos_de_edicion"])) {
            $parameters["permiso_edicion"] = 1;
        }


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

                        $order = 5;
                        if (isset($_REQUEST["order"]) and is_numeric($_REQUEST["order"]) and $_REQUEST["order"] > 0 and $_REQUEST["order"] < 6) {
                            $order = intval($_REQUEST["order"]);
                        }

                        $desc = 0;
                        if (isset($_REQUEST["desc"]) and $_REQUEST["desc"] == 1) {
                            $desc = 1;
                        }

                        $hide_old = 1;
                        if (isset($_REQUEST["hide_old"]) and $_REQUEST["hide_old"] == 0) {
                            $hide_old = 0;
                        }

                        $limit = 5;
                        if (isset($_REQUEST["limit"]) and is_numeric($_REQUEST["limit"]) and $_REQUEST["limit"] > 0 and $_REQUEST["limit"] <= 100) {
                            $limit = intval($_REQUEST["limit"]);
                        }

                        $parameters["tareas_count"] = $tareasServicios->getTareasCountFromCurso($curso, $hide_old);
                        $num_pag = ceil($parameters["tareas_count"] / $limit);

                        $pag = 1;
                        if (isset($_REQUEST["pag"]) and is_numeric($_REQUEST["pag"]) and $_REQUEST["pag"] > 0) {
                            $pag = intval($_REQUEST["pag"]);
                        }

                        if ($pag > $num_pag) {
                            $pag = $num_pag;
                        }


                        $offset = ($pag - 1) * $limit;

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


                        if (isset($_POST["recarga"])) { //No quiero que se pueda mostrar el tbody sin formato si se añade este parámetro a mano
                            $page = "tareas/tabla_tareas.html";
                        } else {
                            $page = ConstantesTareas::MOSTRAR_TAREAS_PAGE;
                        }
                    }
                    break;
                case ConstantesTareas::ACTION_MODIFICAR_TAREA:
                    if ($parameters["permiso_edicion"] = 1) {
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

        //Pintar una pagina de twig
        TwigViewer::getInstance()->viewPage($page, $parameters);
    }

}
