/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var tabla_temas = "";
var tabla_asignaturas = "";
var curso = "";
$(document).ready(function () {
    $(".tab").css("border", "0px");
    $("#mostrar_contenedor_index").css("background", "white");
    $("#mostrar_contenedor_index").css("color", "#008cba");
    $("#mostrar_contenedor_asignaturas").css("background", "#008cba");
    $("#mostrar_contenedor_asignaturas").css("color", "white");
    $(".tab").click(function () {
        var id = $(this).attr("data-target");
        $("." + id).show();
        $(this).css("background", "white");
        if ($(this).attr("data-target") == "div_contenedor_index") {
            $(".contenedor_gestion_asignaturas").hide();
            $("#mostrar_contenedor_asignaturas").css("background", "#008cba");
            $("#mostrar_contenedor_asignaturas").css("color", "white");
            $("#mostrar_contenedor_index").css("color", "#008cba");
        } else {
            $(".div_contenedor_index").hide();
            $("#mostrar_contenedor_index").css("background", "#008cba");
            $("#mostrar_contenedor_index").css("color", "white");
            $("#mostrar_contenedor_asignaturas").css("color", "#008cba");
        }
    });
    $("#select_cursos").on("change", function () {
        curso = $("#select_cursos").val();
        $.ajax({
            url: "/index.php?c=seguimiento_programaciones&destino=asignaturas&a=get_asignatura_curso",
            data: {"id_curso": curso},
            type: "POST",
            success: function (data) {
                $('#select_asignaturas').empty();
                var parseodata = JSON.parse(data);
                $('#select_asignaturas').append($('<option>', {
                    value: "",
                    text: ""
                }));
                if (parseodata.error === undefined) {
                    if (parseodata.asignaturas !== undefined) {
                        for (asignatura in parseodata.asignaturas) {
                            $('#select_asignaturas').append($('<option>', {
                                value: parseodata.asignaturas[asignatura].ID,
                                text: parseodata.asignaturas[asignatura].NOMBRE
                            }));
                        }
                    }
                } else {
                    $.notify({
                        message: parseodata.error
                    }, {
                        type: 'danger',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        z_index: 10000,
                    });
                }
            },
            error: function (data) {
                $.notify({
                    message: "Se ha producido un error al cargar las asignaturas"
                }, {
                    type: 'danger',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    z_index: 10000,
                });
            }
        });
    });
    $(".close").click(function () {
        $('#select_cursos_asignaturas_edit').empty();
        $(".modal").hide();
    });
    $(".cancelar").click(function () {
        $('#select_cursos_asignaturas_edit').empty();
        $(".modal").hide();
    });
    $("#select_asignaturas").change(cambiar_tabla_temas);

    $("#select_cursos-g-a").change(cambiar_tabla_asignaturas);
});
function fn_mostrar_modal_nuevo_tema() {
    $("#modal_add_tema").show();
}
function cambiar_tabla_asignaturas() {
    curso = $("#select_cursos-g-a").val();
    var tabla = document.getElementById("tabla_gestion_asignaturas");
    var longitud_tabla_inicial = tabla.rows.length;
    if (tabla.rows.length > 0) {
        for (var i = longitud_tabla_inicial; i > 1; i--) {
            tabla.deleteRow(i - 1);
        }
    }
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&destino=asignaturas&a=get_asignatura_curso",
        data: {"id_curso": curso},
        type: "POST",
        success: function (data) {
            var parseodata = JSON.parse(data);
            if (parseodata.error === undefined) {
                if (parseodata.asignaturas[0] !== undefined) {
                    for (asignatura in parseodata.asignaturas) {
                        var fila = document.createElement("tr");
                        var celda = document.createElement("td");
                        celda.setAttribute("data-id", parseodata.asignaturas[asignatura].ID);
                        celda.setAttribute("data-curso", curso);
                        celda.setAttribute("class", "name_asignatura");
                        celda.innerHTML = parseodata.asignaturas[asignatura].NOMBRE;
                        fila.appendChild(celda);
                        tabla.appendChild(fila);
                    }
                    var filaboton = document.createElement("tr");
                    var celdaBoton = document.createElement("td");
                    var boton = document.createElement("button");
                    boton.setAttribute("value", "Crear Asignatura");
                    boton.appendChild(document.createTextNode("Crear Asignatura"));
                    boton.setAttribute("id", "abrir_modal_add_asignatura");
                    boton.setAttribute("class", "btn btn-primary col-sm-12");
                    boton.setAttribute("type", "button");
                    celdaBoton.setAttribute("colspan", "3");
                    celdaBoton.appendChild(boton);
                    filaboton.appendChild(celdaBoton);
                    tabla.appendChild(filaboton);
                    $("table").delegate(".name_asignatura", "click", fn_mostrar_modal_actualizar);
                    $("table").delegate("#abrir_modal_add_asignatura", "click", fn_mostrar_modal_crear);
                } else {
                    var fila = document.createElement("tr");
                    var filaboton = document.createElement("tr");
                    var celda = document.createElement("td");
                    var celdaBoton = document.createElement("td");
                    var boton = document.createElement("button");
                    boton.setAttribute("value", "Nueva Asignatura");
                    boton.appendChild(document.createTextNode("Nueva Asignatura"));
                    boton.setAttribute("id", "abrir_modal_add_asignatura");
                    boton.setAttribute("class", "btn btn-primary col-sm-12");
                    boton.setAttribute("type", "button");
                    celda.setAttribute("colspan", "3");
                    celda.innerHTML = "No hay datos";
                    celdaBoton.setAttribute("colspan", "3");
                    celdaBoton.appendChild(boton);
                    fila.appendChild(celda);
                    filaboton.appendChild(celdaBoton);
                    tabla.appendChild(fila);
                    tabla.appendChild(filaboton);
                }
            } else {
                $.notify({
                    message: parseodata.error
                }, {
                    type: 'danger',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    z_index: 10000,
                });
            }
        },
        error: function (data) {
            $.notify({
                message: "Se ha producido un error al cargar las asignaturas"
            }, {
                type: 'danger',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                z_index: 10000,
            });
        }
    });
}
function cambiar_tabla_temas() {
    asignatura = $("#select_asignaturas").val();
    var tabla = document.getElementById("id_temas_asignaturas");
    var longitud_tabla_inicial = tabla.rows.length;
    if (tabla.rows.length > 0) {
        for (var i = longitud_tabla_inicial; i > 1; i--) {
            tabla.deleteRow(i - 1);
        }
    }
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&destino=unidades_trabajo&a=get_asignatura_curso",
        data: {"id_asignatura": asignatura},
        type: "POST",
        success: function (data) {
            var evaluaciones = ["", "Primera Evaluación", "Segunda Evaluación", "Tercera Evaljuación"];
            var parseodata = JSON.parse(data);
            if (parseodata.error === undefined) {
                if (parseodata.unidades[0] !== undefined) {
                    for (tema in parseodata.unidades) {
                        /*tabla_temas.row.add([parseodata.unidades[tema].NOMBRE, parseodata.unidades[tema].EVALUACION, parseodata.unidades[tema].UNIDAD_HECHA]).draw()*/
                        var fila = document.createElement("tr");
                        var filaboton = document.createElement("tr");
                        fila.style.border = "1px solid #e9ecef";
                        var celda1 = document.createElement("td");
                        var celda2 = document.createElement("td");
                        var celda3 = document.createElement("td");
                        var celdaBoton = document.createElement("td");
                        var boton = document.createElement("button");
                        boton.appendChild(document.createTextNode("Crear Tema"));
                        boton.setAttribute("value", "Crear Tema");
                        boton.setAttribute("id", "abrir_modal_add_tema");
                        boton.setAttribute("class", "btn btn-primary col-sm-12");
                        boton.setAttribute("type", "button");
                        celda1.setAttribute("class", "abrir-modal-update-tema puntero");
                        celda1.setAttribute("data-id", parseodata.unidades[tema].ID);
                        celda1.setAttribute("data-estado", parseodata.unidades[tema].UNIDAD_HECHA);
                        celda1.setAttribute("data-comentario", parseodata.unidades[tema].COMENTARIO);
                        celda1.setAttribute("data-nombre", parseodata.unidades[tema].NOMBRE);
                        celda1.setAttribute("data-eva", parseodata.unidades[tema].EVALUACION);
                        celda1.setAttribute("data-asig", asignatura);
                        celda1.innerHTML = parseodata.unidades[tema].NOMBRE;
                        celda2.innerHTML = evaluaciones[parseodata.unidades[tema].EVALUACION];
                        celdaBoton.setAttribute("colspan", "3");
                        celdaBoton.appendChild(boton);
                        if (parseInt(parseodata.unidades[tema].UNIDAD_HECHA) == 1) {
                            var formulario = document.createElement("form");
                            formulario.setAttribute("id", "form_marcar_hecho");
                            var checkbox = document.createElement("input");
                            checkbox.setAttribute("type", "checkbox");
                            checkbox.setAttribute("id", "cambiar_estado_unidad");
                            checkbox.setAttribute("data-id", parseodata.unidades[tema].ID);
                            checkbox.setAttribute("checked", "checked");
                            formulario.appendChild(checkbox);
                            celda3.appendChild(formulario);
                            celda3.setAttribute("data-estado", "1");
                        } else {
                            var formulario = document.createElement("form");
                            formulario.setAttribute("id", "form_marcar_hecho");
                            var checkbox = document.createElement("input");
                            checkbox.setAttribute("type", "checkbox");
                            checkbox.setAttribute("id", "cambiar_estado_unidad");
                            checkbox.setAttribute("data-id", parseodata.unidades[tema].ID);
                            formulario.appendChild(checkbox);
                            celda3.appendChild(formulario);
                            celda3.setAttribute("data-estado", "0");
                        }
                        fila.appendChild(celda1);
                        fila.appendChild(celda2);
                        fila.appendChild(celda3);
                        filaboton.appendChild(celdaBoton);
                        tabla.appendChild(fila);
                        tabla.appendChild(filaboton);

                        $("table").delegate(".abrir-modal-update-tema", "click", fn_mostrar_modal_upt_temas);
                        $("table").delegate("#abrir_modal_add_tema", "click", fn_mostrar_modal_nuevo_tema);
                        $("table").delegate("#cambiar_estado_unidad", "click", marcar_como_hecho_tema);

                    }
                } else {
                    var fila = document.createElement("tr");
                    var filaboton = document.createElement("tr");
                    var celda = document.createElement("td");
                    var celdaBoton = document.createElement("td");
                    var boton = document.createElement("button");
                    boton.setAttribute("value", "Crear Tema");
                    boton.appendChild(document.createTextNode("Crear Tema"));
                    boton.setAttribute("id", "abrir_modal_add_tema");
                    boton.setAttribute("class", "btn btn-primary col-sm-12");
                    boton.setAttribute("type", "button");
                    celda.setAttribute("colspan", "3");
                    celda.innerHTML = "No hay datos";
                    celdaBoton.setAttribute("colspan", "3");
                    celdaBoton.appendChild(boton);
                    fila.appendChild(celda);
                    filaboton.appendChild(celdaBoton);
                    tabla.appendChild(fila);
                    tabla.appendChild(filaboton);
                }
            } else {
                $.notify({
                    message: parseodata.error
                }, {
                    type: 'danger',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    z_index: 10000,
                });
            }
        },
        error: function (data) {
            $.notify({
                message: "Se ha producido un error al cargar las asignaturas"
            }, {
                type: 'danger',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                z_index: 10000,
            });
        }
    });
}

function fn_mostrar_modal_upt_temas(){
    var formulario = document.getElementById("updateTema");
    $("#nombre_tema_update").val($(this).attr("data-nombre"));
    $("#nombre_tema_update").attr("data-id",$(this).attr("data-id"));
    $("#comentario_tema").val($(this).attr("data-comentario"));
    
    // SELECCIONAR ASIGNATURA DEL TEMA EN EL SELECT
    $("#select_evaluacion_update").val($(this).attr("data-eva"));
    var texto = $("#select_evaluacion_update option:selected").text();
    $("#select_evaluacion_update option:selected").text(texto + "------------")
    
    // SELECCIONAR ASIGNATURA DEL TEMA EN EL SELECT
    $("#select_asignaturas_temas_update").val($(this).attr("data-asig"));
    var texto = $("#select_asignaturas_temas_update option:selected").text();
    $("#select_asignaturas_temas_update option:selected").text(texto + "------------");
    
    $("#modal_update_tema").show();
}


function fn_mostrar_modal_actualizar() {
    $("#modal_update_asignatura").show();
    $("#nombre_asignatura_update").val($(this).text());
    $("#nombre_asignatura_update").attr("data-id", $(this).attr("data-id"));
    console.log($(this).attr("data-curso"));
    $("#select_cursos_asignaturas_edit").val($(this).attr("data-curso"));
    var texto = $("#select_cursos_asignaturas_edit option:selected").text();
    $("#select_cursos_asignaturas_edit option:selected").text(texto + "------------")
    
}