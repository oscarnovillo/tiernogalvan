<?php

namespace servicios\tareas;

class TareasTextosServicios {

    public function getTextos($idioma) {
        $textos = new \stdClass;

        if ($idioma != "es" and $idioma != "en") {
            $idioma = "es";
        }
        
        switch ($idioma) {
            case "es":
                /* Textos lista de cursos */
                $textos->TareasParaAlumnos = "Tareas para alumnos";
                $textos->SeleccioneCursoMostrarTareas = "Seleccione un curso para mostrar las tareas correspondientes.";
                $textos->CampoNombre = "Nombre";
                $textos->CampoTipo = "Tipo";
                $textos->CampoTurno = "Turno";
                $textos->ESO = "E.S.O.";
                $textos->BACH = "Bachillerato";
                $textos->FPB = "F.P. Básica";
                $textos->FPGM = "F.P. Grado Medio";
                $textos->FPGS = "F.P. Grado Superior";
                $textos->TurnoManana = "Mañana";
                $textos->TurnoTarde = "Tarde";
                $textos->NoHayCursos = "(No se han encontrado cursos)";
                        
                
                
                /* Título */
                $textos->TareasParaAlumnosNoHayCurso = "Tareas para alumnos de... vaya, ha habido un error";
                $textos->TareasParaAlumnosDe = "Tareas para alumnos de";

                /* Campos */
                $textos->CampoDescripcion = "Descripción de la tarea";
                $textos->CampoAsignatura = "Asignatura / Módulo";
                $textos->CampoFecha = "Fecha";
                $textos->CampoPrioridad = "Prioridad";
                $textos->CampoAcciones = "Acciones";
                
                /* Prioridad */
                $textos->Finalizo = "Finalizó hace";
                $textos->Quedan = "Quedan";
                $textos->Hoy = "Hoy";
                $textos->Manana= "Mañana";
                $textos->Dia= "día";
                $textos->Dias= "días";
                               
                /* Acciones */
                $textos->Ok = "Aceptar";
                $textos->Cancelar = "Cancelar";
                $textos->Editar = "Editar";
                $textos->Borrar = "Borrar";
                $textos->Anadir = "Nueva tarea";
                
                /* Footer tabla */
                $textos->OcultarTareas = "Ocultar tareas pasadas";
                $textos->NumPagsPagina = "Nº tareas/página:";
                
                $textos->Primera = "Primera";
                $textos->Anterior = "Anterior";
                $textos->Siguiente = "Siguiente";
                $textos->Ultima = "Última";
                
                
                /* Volver */
                $textos->Volver= "Volver";
                
                /* Cuando no hay nada*/
                $textos->CursoNoExiste = "(El curso no existe)";
                $textos->NoHayTareas = "(No se han encontrado tareas)";
                
                /* Por defecto*/
                $textos->NuevaTareaDefault = "Nueva tarea";
                $textos->NuevaAsignaturaDefault = "Nueva asignatura";
                
                /* Avisos / Errores */
                $textos->strFalloOperacion = "Fallo en la operación";
                $textos->strCamposNulos = "No puede haber campos nulos.";
                $textos->strCanceladoOperacion = "Se ha cancelado la operación";

                $textos->strSeguroCrear = "¿Seguro que desea crear esta tarea?";
                $textos->strSeguroModificar = "¿Seguro que desea modificar esta tarea?";
                $textos->strSeguroBorrar = "¿Seguro que desea borrar esta tarea?";

                
                $textos->strCrearOK = "Se ha creado la tarea correctamente";
                $textos->strModificarOK = "Se ha modificado la tarea correctamente";
                $textos->strBorrarOK = "Se ha eliminado satisfactoriamente la tarea";

                $textos->strFormatoFecha = "La fecha no se ha introducido en el formato yyyy-mm-dd.";
                $textos->strTareaPasado = "No se pueden poner tareas en el pasado.";
                $textos->strTareaFuturo = "No se pueden poner tareas de aquí a dentro de 2 años.";

                
                break;
            case "en":
                /* Textos lista de cursos */
                $textos->TareasParaAlumnos = "Tasks for students";
                $textos->SeleccioneCursoMostrarTareas = "Select a course to show its corresponding tasks.";
                $textos->CampoNombre = "Name";
                $textos->CampoTipo = "Type";
                $textos->CampoTurno = "Shift";
                $textos->ESO = "General Certificate of Secondary Education (GCSE)";
                $textos->BACH = "General Certificate of Education (GCE)";
                $textos->FPB = "Basic Vocational Training";
                $textos->FPGM = "Vocational Education and Training (VET)";
                $textos->FPGS = "Certificate of Higher Education (HNC)";
                $textos->TurnoManana = "Morning";
                $textos->TurnoTarde = "Afternoon";
                $textos->NoHayCursos = "(No courses found)";
                
                

                /* Título */
                $textos->TareasParaAlumnosNoHayCurso = "Tasks for students of... oops, something happened";
                $textos->TareasParaAlumnosDe = "Tasks for students of";
                
                /* Campos */
                $textos->CampoDescripcion = "Task description";
                $textos->CampoAsignatura = "Subject";
                $textos->CampoFecha = "Date";
                $textos->CampoPrioridad = "Priority";
                $textos->CampoAcciones = "Actions";
                
                /* Prioridad */
                $textos->Finalizo = "Ended:";
                $textos->Quedan = "Remaining:";
                $textos->Hoy = "Today";
                $textos->Manana= "Tomorrow";
                $textos->Dia= "day";
                $textos->Dias= "days";
                
                /* Acciones */
                $textos->Ok = "Accept";
                $textos->Cancelar = "Cancel";
                $textos->Editar = "Edit";
                $textos->Borrar = "Delete";
                $textos->Anadir = "New task";
                
                /* Footer tabla */
                $textos->OcultarTareas = "Hide old tasks";
                $textos->NumPagsPagina = "No. tasks/page:";
                
                $textos->Primera = "First";
                $textos->Anterior = "Previous";
                $textos->Siguiente = "Next";
                $textos->Ultima = "Last";
                
                /* Volver */
                $textos->Volver= "Go back";
                
                /* Cuando no hay nada*/
                $textos->CursoNoExiste = "(Course doesn't exist)";
                $textos->NoHayTareas = "(No tasks found)";
                
                /* Por defecto*/
                $textos->NuevaTareaDefault = "New task";
                $textos->NuevaAsignaturaDefault = "New subject";
                
                /* Avisos / Errores */
                $textos->strFalloOperacion = "Operation failed";
                $textos->strCamposNulos = "Fields can't have null values.";
                $textos->strCanceladoOperacion = "Operation was canceled";

                $textos->strSeguroCrear = "Are you sure you want to create this task?";
                $textos->strSeguroModificar = "Are you sure you want to edit this task?";
                $textos->strSeguroBorrar = "Are you sure you want to delete this task";

                $textos->strCrearOK = "Task was created sucessfully";
                $textos->strModificarOK = "Task was modified sucessfully";
                $textos->strBorrarOK = "Task was deleted sucessfully";
                
                $textos->strFormatoFecha = "Date must be on yyyy-mm-dd format.";
                $textos->strTareaPasado = "You can't put tasks on the past.";
                $textos->strTareaFuturo = "You can't put tasks from more than 2 years in the future.";
                break;
        }
        return $textos;
    }

}
