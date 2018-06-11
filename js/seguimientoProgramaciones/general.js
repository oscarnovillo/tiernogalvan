/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var tabla_temas = "";
var tabla_asignaturas = "";
var curso = "";
$(document).ready(function () {
    tabla_asignaturas = $("#tabla_gestion_asignaturas").DataTable();
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
    $("#select_asignaturas").on("change", function () {
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
                var parseodata = JSON.parse(data);
                console.log(parseodata.unidades[0]);
                if (parseodata.error === undefined) {
                    if (parseodata.unidades[0] !== undefined) {
                        for (tema in parseodata.unidades) {
                            /*tabla_temas.row.add([parseodata.unidades[tema].NOMBRE, parseodata.unidades[tema].EVALUACION, parseodata.unidades[tema].UNIDAD_HECHA]).draw()*/
                            var fila = document.createElement("tr");
                            fila.style.border = "1px solid #e9ecef";
                            var celda1 = document.createElement("td");
                            var celda2 = document.createElement("td");
                            var celda3 = document.createElement("td");
                            celda1.setAttribute("class", "abrir-modal-update-tema puntero");
                            celda1.setAttribute("data-id", parseodata.unidades[tema].ID);
                            celda1.innerHTML = parseodata.unidades[tema].NOMBRE;
                            celda2.innerHTML = parseodata.unidades[tema].EVALUACION;
                            if (parseInt(parseodata.unidades[tema].UNIDAD_HECHA) == 1) {
                                var formulario = document.createElement("form");
                                formulario.setAttribute("name", "form_estado");
                                formulario.setAttribute("id", "form_estado");
                                var checkbox = document.createElement("checkbox");
                                checkbox.setAttribute("class", "marcar_hecho");
                                checkbox.setAttribute("data-id", parseodata.unidades[tema].ID);
                                checkbox.setAttribute("checked", "checked");
                                formulario.appendChild(checkbox);
                                celda3.appendChild(formulario);
                            } else {
                                var formulario = document.createElement("form");
                                formulario.setAttribute("name", "form_estado");
                                formulario.setAttribute("id", "form_estado");
                                var checkbox = document.createElement("checkbox");
                                checkbox.setAttribute("class", "marcar_hecho");
                                checkbox.setAttribute("data-id", parseodata.unidades[tema].ID);
                                formulario.appendChild(checkbox);
                                celda3.appendChild(formulario);
                            }
                            fila.appendChild(celda1);
                            fila.appendChild(celda2);
                            fila.appendChild(celda3);
                            tabla.appendChild(fila);
                        }
                    } else {
                        var fila = document.createElement("tr");
                        var celda = document.createElement("td");
                        celda.setAttribute("colspan","3");
                        celda.innerHTML = "No hay datos";
                        fila.appendChild(celda);
                        tabla.appendChild(fila);
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
});
