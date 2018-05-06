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
        $parameters["action_editar_curso"] = ConstantesTareas::ACTION_EDITAR_CURSO;

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
                        $parameters["nombre_curso"] = $tareasServicios->getNombreCurso($curso);
                        
                        $page = ConstantesTareas::VER_TAREAS_PAGE;   
                    }
                    break;
                /* Editar las tareas de un curso */
                case ConstantesTareas::ACTION_EDITAR_CURSO:
                    //¿Qué curso? -> Comprobar segundo parámetro
                    if (isset($_REQUEST[ConstantesTareas::ACTION_ID_CURSO])) {
                        $curso = $_REQUEST[ConstantesTareas::ACTION_ID_CURSO];
                        
                        $tareasServicios = new TareasServicios();
                        $parameters["tareas"] = $tareasServicios->getAllTareasFromCurso($curso);
                        $parameters["nombre_curso"] = $tareasServicios->getNombreCurso($curso);
                        $parameters["asignaturas"] = $tareasServicios->getAsignaturasCurso($curso);

                        $parameters["editar_campo_ok"] = ConstantesTareas::EDITAR_CAMPO_OK;  
                        $parameters["editar_campo_cancelar"] = ConstantesTareas::EDITAR_CAMPO_CANCELAR;  
                        $parameters["editar_campo_ok_tooltip"] = ConstantesTareas::EDITAR_CAMPO_OK_TOOLTIP;  
                        $parameters["editar_campo_cancelar_tooltip"] = ConstantesTareas::EDITAR_CAMPO_CANCELAR_TOOLTIP; 
                        
                        $page = ConstantesTareas::EDITAR_TAREAS_PAGE;   
                    }
                    break;
            }
        }

        //Pintar una pagina de twig
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }

}
