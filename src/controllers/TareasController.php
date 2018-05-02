<?php

namespace controllers;

use utils\Constantes;
use utils\tareas\ConstantesTareas;
use servicios\tareas\TareasServicios;
use utils\TwigViewer;

class TareasController {

    public function tareas() {
        
        /*
         * TODO:
         * 
         * Si no hay parámetros puestos:
         * Mostrar un listado con todos los cursos disponibles.
         * (select * from cursos)
         * (cursos tiene id_curso, nombre_curso)
         * 
         * Si hay parámetros puestos (acción: ver 1º DAW)
         * Mostrar las tareas de ese curso
         * (select * from tareas when curso=<número>)
         * (tareas tiene id_tarea, id_curso, descripcion, asignatura, fecha)
         * 
         * Si eres profesor: opciones de CRUD
         * 
         *   

        */
        
        
        $parameters = array();
        
        
        if (isset($_REQUEST[Constantes::PARAMETER_NAME_ACTION])) {
            $action = $_REQUEST[Constantes::PARAMETER_NAME_ACTION];
            
            switch ($action) {
                case ConstantesTareas::ACTION_VER_CURSO:
                    //¿Qué curso quieres listar?
                    if (isset($_REQUEST[ConstantesTareas::ACTION_ID_CURSO])) {
                        $curso = $_REQUEST[ConstantesTareas::ACTION_ID_CURSO];
                        
                        $tareasServicios = new TareasServicios();
                        $parameters["tareas"] = $tareasServicios->getAllTareasFromCurso($curso);
                        
                        $parameters["nombre_curso"] = $tareasServicios->getNombreCurso($curso);
                        $page = ConstantesTareas::TAREAS_CURSO_PAGE;   
                    }
                    break;
            }
        } else {
            //Obtener lista de cursos
            $page = ConstantesTareas::MOSTRAR_CURSOS_PAGE;
            $tareasServicios = new TareasServicios();
            $parameters["cursos"] = $tareasServicios->getAllCursos();
            
            $parameters["action_ver_curso"] = ConstantesTareas::ACTION_VER_CURSO;
        }
      
        
        //con esto se pinta una pagina de twig
        TwigViewer::getInstance()->viewPage($page,$parameters);
    }

}
