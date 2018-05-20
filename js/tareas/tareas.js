var campos = ["descripcion", "asignatura", "fecha"];
var strFalloOperacion = "Fallo en la operación";
var strCamposNulos = "No puede haber campos nulos."
var strCanceladoOperacion = "Se ha cancelado la operación"

var strSeguroCrear = "¿Seguro que desea crear esta tarea?"
var strSeguroModificar = "¿Seguro que desea modificar esta tarea?"
var strSeguroBorrar = "¿Seguro que desea borrar esta tarea?"

var strModificarOK = "Se ha modificado la tarea correctamente";
var strBorrarOK = "Se ha eliminado satisfactoriamente la tarea";


function mostrar_mensaje(tipo, texto) {
    $("#mensaje").hide();
    $("#mensaje").attr('class', 'mensaje_' + tipo);
    $("#mensaje").html(texto);
    $("#mensaje").fadeIn(500);
}

/* Comprobaciones */

function seHaModificadoLaTarea(id) {
    var hayCambios = false;
    for (i = 0; i < campos.length; i++) {
        var campo_original = $("#" + campos[i] + "_original" + id).val();
        var campo_nuevo = $("#" + campos[i] + id).val();

        if (campo_nuevo != campo_original) {
            hayCambios = true;
        }
    }
    return hayCambios;
}

function hayCamposNulos(id) {
    var hayNulos = false;
    for (i = 0; i < campos.length; i++) {
        var campo_nuevo = $("#" + campos[i] + id).val();

        if (campo_nuevo == "") {
            alert(strCamposNulos);
            hayNulos = true;
        }
    }
    return hayNulos;
}

function comprobarFechas(campo_nuevo) {
    var fechaEsCorrecta = false;
    var patt = /^\d{4}-\d{2}-\d{2}$/g;
    if (!patt.test(campo_nuevo)) {
        alert("La fecha no se ha introducido en el formato yyyy-mm-dd.");
        fechaEsCorrecta = true;
    } else {
        var anio_introducido = parseInt(campo_nuevo.substr(0, 4));
        var anio_actual = (new Date()).getFullYear();

        if (anio_introducido < anio_actual) {
            alert("No se pueden poner tareas en el pasado.");
            fechaEsCorrecta = true;
        }

        if (anio_introducido > anio_actual + 2) {
            alert("No se pueden poner tareas de aquí a dentro de 2 años.");
            fechaEsCorrecta = true;
        }
    }
    return fechaEsCorrecta;
}

/* Crear, modificar, borrar */

function crearNuevaTarea() {
    var id = "Nueva";
    var hayProblemas = hayCamposNulos(id);
    
    if (!hayProblemas) {
        hayProblemas = comprobarFechas($("#fecha" + id).val());
    }

    if (!hayProblemas) {
        var confirmar_editar = confirm(strSeguroCrear);

        if (confirmar_editar) {
            ajax_crear(id);

        } else {
            mostrar_mensaje("aviso", strCanceladoOperacion);
            restaurar_campo(campo, id)
        }
    }
}

function modificar(id) {
    var hayProblemas = !seHaModificadoLaTarea(id);

    if (!hayProblemas) {
        hayProblemas = hayCamposNulos(id);
    }
    
    if (!hayProblemas) {
        hayProblemas = comprobarFechas($("#fecha" + id).val());
    }
    
    if (!hayProblemas) {
        var confirmar_editar = confirm(strSeguroModificar);

        if (confirmar_editar) {
            ajax_modificar(id);

        } else {
            mostrar_mensaje("aviso", strCanceladoOperacion);
            restaurar_campo(campo, id)
        }
    }
}

function borrar(id) {
    var borrar_tarea = confirm(strSeguroBorrar);
    if (borrar_tarea) {
        ajax_borrar(id);
    } else {
        mostrar_mensaje("aviso", strCanceladoOperacion);
    }
}


function restaurarCampoSiVacio(campo, id) {
    if ($("#" + campo + id).val() == '') {
        $("#" + campo + id).val($("#" + campo + "_original" + id).val())
        $("#btns_" + campo + id).hide();
    }
}


function enviarEnter(e, id) {
    if (e.keyCode == 13) {              // Enter. Aceptar
        modificar(id);
    } else if (e.keyCode == 27) {       // Escape. Cancelar
        cancelar(id);
    }
}

function enviarEnterNueva(e) {
    if (e.keyCode == 13) {              // Enter. Aceptar
        crearNuevaTarea();
    } else if (e.keyCode == 27) {       // Escape. Cancelar
        cancelarNuevaTarea();
    }
}


function editar(id) {
    $("#descripcion_txt" + id).hide();
    $("#asignatura_txt" + id).hide();
    $("#fecha_txt" + id).hide();

    $("#descripcion" + id).attr("type", "input");
    $("#asignatura" + id).attr("type", "input");
    $("#fecha" + id).attr("type", "date");

    $("#btn_edit" + id).hide();
    $("#btn_borrar" + id).hide();

    $("#btn_cancelar" + id).show();
}

function cancelar(id) {
    for (i = 0; i < campos.length; i++) {
        $("#" + campos[i] + id).val($("#" + campos[i] + "_original" + id).val())
    }
    fin_editar(id);
}

function fin_editar(id) {
    $("#descripcion_txt" + id).show();
    $("#asignatura_txt" + id).show();
    $("#fecha_txt" + id).show();

    $("#descripcion" + id).attr("type", "hidden");
    $("#asignatura" + id).attr("type", "hidden");
    $("#fecha" + id).attr("type", "hidden");

    $("#btn_edit" + id).show();
    $("#btn_ok" + id).hide();
    $("#btn_cancelar" + id).hide();
    $("#btn_borrar" + id).show();
}




function mostrarBotonModificar(id) {
    if (seHaModificadoLaTarea(id)) {
        $("#btn_ok" + id).show();
    } else {
        $("#btn_ok" + id).hide();
    }
}


function mostrarCrearTarea() {
    $("#descripcionNueva").val("Nueva tarea");
    $("#asignaturaNueva").val("Asignatura");

    $("#fila_tareaNueva").fadeIn(500);
    $("#noHayTareas").hide();
    $("#fila_add").hide();

}

function cancelarNuevaTarea() {
    $("#fila_tareaNueva").hide();
    $("#fila_add").fadeIn(500);
}


/* AJAX */

function ajax_crear() {
    $.ajax({
        type: 'post',
        url: 'index.php?c=tareas&a=crear_tarea',
        method: 'POST',
        data: {
            'id_curso': $("#id_curso").val(),
            'descripcion': $("#descripcionNueva").val(),
            'asignatura': $("#asignaturaNueva").val(),
            'fecha': $("#fechaNueva").val()
        },
        success: function (response) {
            mostrar_mensaje("ok", "ok");
            $("#fila_tareaNueva").hide();
            $("#fila_add").fadeIn(500);
            location = location;    //TODO: cambiar esta recarga cutre (para mostrar el campo nuevo creado en la tabla) y pintarlo bonito dinámicamente
        },
        error: function (response) {
            mostrar_mensaje("error", strFalloOperacion);
        }
    });
}


function ajax_modificar(id) {
    $.ajax({
        type: 'post',
        url: 'index.php?c=tareas&a=modificar_tarea',
        method: 'POST',
        data: {
            'id': id,
            'descripcion': $("#descripcion" + id).val(),
            'asignatura': $("#asignatura" + id).val(),
            'fecha': $("#fecha" + id).val(),
        },
        success: function (response) {

            for (i = 0; i < campos.length; i++) {
                var campo_original = $("#" + campos[i] + "_original" + id);
                var campo_txt = $("#" + campos[i] + "_txt" + id);

                var campo_nuevo = $("#" + campos[i] + id).val();

                campo_original.val(campo_nuevo);
                campo_txt.html(campo_nuevo);
            }
            var fecha_nueva = Date.parse($("#fecha" + id).val(), "yyyy-dd-mm");
            var fecha_hoy = new Date().setUTCHours(0, 0, 0, 0);

            var cambiarColorId = "#fecha_txt" + id;
            $(cambiarColorId).removeClass("tarea_hoy");
            $(cambiarColorId).removeClass("tarea_caducada");

            if (fecha_nueva == fecha_hoy) {
                $(cambiarColorId).addClass("tarea_hoy");
            } else if (fecha_nueva < fecha_hoy) {
                $(cambiarColorId).addClass("tarea_caducada");
            }

            mostrar_mensaje("ok", strModificarOK);
            fin_editar(id);

        },
        error: function (response) {
            mostrar_mensaje("error", strFalloOperacion);
        }
    });
}


function ajax_borrar(id) {
    $.ajax({
        type: 'post',
        url: 'index.php?c=tareas&a=borrar_tarea',
        method: 'POST',
        data: {
            'id': id,
        },
        success: function (response) {
            $("#fila_tarea" + id).fadeOut(500);
            mostrar_mensaje("ok", strBorrarOK);
        },
        error: function (response) {
            mostrar_mensaje("error", strFalloOperacion);
        }
    });
}