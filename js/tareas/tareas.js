var campos = ["descripcion", "asignatura", "fecha"];
/* Mostrar la barra de mensaje al añadir/editar/borrar tareas:
 * - Tipo: si es ok, sale verde. Si es aviso, sale amarillo. Si es error, rojo.
 * - Texto: el texto
 */

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
            alert($("#strCamposNulos").val());
            hayNulos = true;
        }
    }
    return hayNulos;
}

function comprobarFechas(campo_nuevo) {
    var fechaEsCorrecta = false;
    var patt = /^\d{4}-\d{2}-\d{2}$/g;
    if (!patt.test(campo_nuevo)) {
        alert($("#strFormatoFecha").val());
        fechaEsCorrecta = true;
    } else {
        var fecha_introducida = new Date(campo_nuevo);
        var fecha_actual = (new Date());

        if (fecha_introducida.getTime()+(24*60*60*1000) < fecha_actual.getTime()) {
            alert($("#strTareaPasado").val());
            fechaEsCorrecta = true;
        }

        if (fecha_introducida.getFullYear() > fecha_actual.getFullYear() + 2) {
            alert($("#strTareaFuturo").val());
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
        var confirmar_editar = confirm($("#strSeguroCrear").val());
        if (confirmar_editar) {
            ajax_crear(id);
        } else {
            mostrar_mensaje("aviso", $("#strCanceladoOperacion").val());
            /*cancelarNuevaTarea();*/
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
        var confirmar_editar = confirm($("#strSeguroModificar").val());
        if (confirmar_editar) {
            ajax_modificar(id);
        } else {
            mostrar_mensaje("aviso", $("#strCanceladoOperacion").val());
            /*cancelar(id);*/
        }
    }
}

function borrar(id) {
    var borrar_tarea = confirm($("#strSeguroBorrar").val());
    if (borrar_tarea) {
        ajax_borrar(id);
    } else {
        mostrar_mensaje("aviso", $("#strCanceladoOperacion").val());
    }
}


function restaurarCampoSiVacio(campo, id) {
    if ($("#" + campo + id).val() == '') {
        $("#" + campo + id).val($("#" + campo + "_original" + id).val())
        $("#btns_" + campo + id).hide();
    }
}

/* Para aceptar o cancelar por teclado */

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

/* Al darle a editar, ocultar los textos planos de la fila, mostrar en su lugar
 * los inputs editables. Ocultar botones Editar y Borrar, mostrar Cancelar */
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

/* Al cancelar, asignar a todos los campos los valores originales que tenían */
function cancelar(id) {
    for (i = 0; i < campos.length; i++) {
        $("#" + campos[i] + id).val($("#" + campos[i] + "_original" + id).val())
    }
    fin_editar(id);
}

/* Al salir de editar campos, ocultar los inputs editables y mostrar los textos
 * planos. Ocultar botones Ok y Cancelar, mostrar Editar y Borrar */
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


/* Cuando se ha editado al menos un campo de la fila, que muestre el botón 
 * para aceptar */
function mostrarBotonModificar(id) {
    if (seHaModificadoLaTarea(id)) {
        $("#btn_ok" + id).show();
    } else {
        $("#btn_ok" + id).hide();
    }
}

/* Cuando le das a añadir tarea, muestra una fila editable originalmente oculta
 * para poder meter los datos */
function mostrarCrearTarea() {
    $("#descripcionNueva").val($("#NuevaTareaDefault").val());
    $("#asignaturaNueva").val($("#NuevaAsignaturaDefault").val());
    $("#fila_tareaNueva").fadeIn(500);
    $("#noHayTareas").hide();
    $("#fila_add").hide();
}

/* Si no quieres crear una nueva tarea, oculta la fila editable y muestra el 
 * botón de Añadir que estaba */
function cancelarNuevaTarea() {
    $("#fila_tareaNueva").hide();
    $("#fila_add").fadeIn(500);
}


/* AJAX */

function ajax_crear() {
    $("#cargando").show();
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
            $("#cargando").hide();
            mostrar_mensaje("ok", $("#strCrearOK").val());
            $("#fila_tareaNueva").hide();
            $("#fila_add").fadeIn(500);
            recargarTabla()
        },
        error: function (response) {
            $("#cargando").hide();
            mostrar_mensaje("error", $("#strFalloOperacion").val());
        }
    });
}

function ajax_modificar(id) {
    $("#cargando").show();
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
            $("#cargando").hide();
            /* Asignar al texto plano de los campos los nuevos valores */
            for (i = 0; i < campos.length; i++) {

                var campo_original = $("#" + campos[i] + "_original" + id);
                var campo_txt = $("#" + campos[i] + "_txt" + id);
                var campo_nuevo = $("#" + campos[i] + id).val();
                campo_original.val(campo_nuevo);
                campo_txt.html(campo_nuevo);
            }

            mostrar_mensaje("ok", $("#strModificarOK").val());
            fin_editar(id);
            recargarTabla()

        },
        error: function (response) {
            $("#cargando").hide();
            mostrar_mensaje("error", $("#strFalloOperacion").val());
        }
    });
}


function ajax_borrar(id) {
    $("#cargando").show();
    $.ajax({
        type: 'post',
        url: 'index.php?c=tareas&a=borrar_tarea',
        method: 'POST',
        data: {
            'id': id,
        },
        success: function (response) {
            $("#cargando").hide();
            $("#fila_tarea" + id).fadeOut(500);
            mostrar_mensaje("ok", $("#strBorrarOK").val());
            recargarTabla()
        },
        error: function (response) {
            $("#cargando").hide();
            mostrar_mensaje("error", $("#strFalloOperacion").val());
        }
    });
}

/* Cuando pinchas en una cabecera, almacena en un input hidden el número
 * correspondiente de esa columna (tiene que ser en el orden en que está
 * en la base de datos)
 * 
 * También cambia la clase para cambiar la flecha (si estaba arriba,
 * se pone abajo y viceversa), cambiando la clase con el icono correspondiente
 * de FontAwesome, y almacena en otro input hidden si ordena descendente o no.
 * 
 * Luego la función recargarTabla le pasa esos valores al php y este a su vez pueda
 * darle al SQL el "order by <param_order>" y un "desc" sólo si es descendiente.
 */
function reordenar(columnaBBDD, idTh) {
    $('#param_order').val(columnaBBDD);
    if ($('#' + idTh).hasClass("fa-sort-up")) {
        $('#' + idTh).toggleClass('fa-sort-up fa-sort-down');
        $('#param_desc').val(0);
    } else {
        $('#' + idTh).toggleClass('fa-sort-down fa-sort-up');
        $('#param_desc').val(1);
    }

    recargarTabla()
}


/* Cuando has hecho una operación que requiere recargar los datos, esta función
 * coge los valores de distintos input hidden para luego pasárselos por AJAX
 * al TareasController, con la diferencia de que en lugar de recargar la página
 * entera, le paso un parámetro "recarga" para que el Controller sólo cargue
 * la plantilla de la tabla. Y luego hago que esa plantilla se pinte sólo en el
 * div que contiene la tabla. 
 */

function recargarTabla() {
    $("#cargando").show();
    var hide_old = 0;
    if ($("#param_hide_old").prop("checked")) {
        hide_old = 1;
    }

    $.post('/index.php', {
        c: "tareas",
        a: "ver_curso",
        id_curso: $("#param_curso").val(),
        order: $("#param_order").val(),
        desc: $("#param_desc").val(),
        limit: $("#param_limit").val(),
        pag: $("#param_pag").val(),
        hide_old: hide_old,
        recarga: true
    }
    , function (data) {
        $('#tbody_recarga').html(data);
        $("#cargando").hide();
    });
}


function paginador(num) {
    if (num < $("#num_pag").val()) {
        $("#param_pag").val(parseInt(num));
    } else {
        $("#param_pag").val(parseInt($("#num_pag").val()));
    }
    recargarTabla();
}

function num_pags(num) {
    $("#param_pag").val(1);
    recargarTabla();
}
