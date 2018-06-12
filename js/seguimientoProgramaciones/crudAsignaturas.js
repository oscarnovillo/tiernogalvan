/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $("#aceptar_envio").click(function () {
        fn_crear_asignatura();
    });
    $("#aceptar_envio_update").click(function () {
        fn_update_asignatura();
    });
    $("#borrar_asignatura").click(function () {
        fn_borrar_asignatura();
    });
    $(".name_asignatura").on("click", function () {
        fn_mostrar_modal_actualizar($(this).text(), $(this).attr("data-id"));
    });
    $("#borrado_total").click(fn_borrado_total_asignatura);
    
    
    $("#cancelar_borrado").click(function(){
        $("#modal_aviso_borrar_asignatura").hide();
        $.notify({
                message: "No se ha realizado ninguna acción"
            }, {
                type: 'info',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                z_index: 10000,
            });
    });
});
function fn_mostrar_modal_actualizar(nombre_asig, id_asig) {
    $("#modal_update_asignatura").show();
    $("#nombre_asignatura_update").val(nombre_asig);
    $("#nombre_asignatura_update").attr("data-id", id_asig);
    var asignatura = JSON.stringify({
        'id_asignatura': id_asig
    });
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&destino=get_cursos_asignaturas&a=get_asignatura_curso",
        type: "POST",
        data: {'json_asignatura': asignatura},
        success: function (data) {
            console.log(data);
            var parseodata = JSON.parse(data);
            if (parseodata.curso_asignatura[0] !== undefined) {
                $("#select_cursos_asignaturas_edit").append($('<option>', {
                    value: parseodata.curso_asignatura[0].id_curso,
                    text: parseodata.curso_asignatura[0].nombre_curso + "----------------------------"
                }));
            }
            if (parseodata.error === undefined) {
                for (curso in parseodata.cursos) {
                    if (parseodata.curso_asignatura[0] !== undefined) {
                        if (parseodata.cursos[curso].id_curso != parseodata.curso_asignatura[0].id_curso) {
                            $("#select_cursos_asignaturas_edit").append($('<option>', {
                                value: parseodata.cursos[curso].id_curso,
                                text: parseodata.cursos[curso].nombre_curso
                            }));
                        }
                    } else {
                        $("#select_cursos_asignaturas_edit").append($('<option>', {
                            value: parseodata.cursos[curso].id_curso,
                            text: parseodata.cursos[curso].nombre_curso
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
        }
    });
}
function fn_crear_asignatura() {
    datos = JSON.stringify({
        "nombre": $("#nombre_asignatura").val(),
        "id_curso": $("#select_cursos_asignaturas").val()
    });
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&destino=asignaturas&a=insertar",
        type: "POST",
        data: {'json_asignatura': datos},
        success: function (data) {
            var parseodata = JSON.parse(data);
            if (parseodata.error === undefined) {
                $.notify({
                    message: parseodata.exito
                }, {
                    type: 'success',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    z_index: 10000,
                });
                location.reload(true);
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
                message: "Se ha producido un error"
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

function fn_update_asignatura() {

    var asignatura_act = JSON.stringify({
        'nombre': $("#nombre_asignatura_update").val(),
        'id_asignatura': $("#nombre_asignatura_update").attr("data-id"),
        'id_curso': $("#select_cursos_asignaturas_edit").val()
    });
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&destino=asignaturas&a=modificar",
        data: {'json_asignatura': asignatura_act},
        type: "POST",
        success: function (data) {
            console.log(data);
            var parseodata = JSON.parse(data);
            if (parseodata.error === undefined) {
                $.notify({
                    message: parseodata.exito
                }, {
                    type: 'success',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    z_index: 10000,
                });
                location.reload(true);
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
                message: "Se ha producido un error"
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

function fn_borrar_asignatura() {
    var asignatura = JSON.stringify({
        'id_asignatura': $("#nombre_asignatura_update").attr("data-id")
    });
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&destino=asignaturas&a=borrar",
        data: {'json_asignatura': asignatura},
        type: "POST",
        success: function (data) {
            console.log(data);
            var parseodata = JSON.parse(data);
            console.log(parseodata)
            if (parseodata.ferror === undefined) {
                if (parseodata.error === undefined) {
                    $.notify({
                        message: parseodata.exito
                    }, {
                        type: 'success',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        z_index: 10000,
                    });
                    location.reload(true);
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
            } else {
                console.log(parseodata.ferror);
                $("#mensaje_borrado_total").text(parseodata.ferror);
                $("#modal_aviso_borrar_asignatura").show();
                $("#modal_update_asignatura").hide();
                $("#borrado_total").attr("data-id",parseodata.id)
            }
        },
        error: function (data) {
            $.notify({
                message: "Se ha producido un error"
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

function fn_borrado_total_asignatura(){
    var asignatura = JSON.stringify({
        'id_asignatura': $(this).attr("data-id"),
    });
    console.log($(this));
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&a=borrado_total&destino=asginaturas",
        data: {'json_asignatura': asignatura},
        type: "POST",
        success: function (data) {
            console.log(data);
            var parseodata = JSON.parse(data);
            if (parseodata.mensaje.error === undefined) {
                $.notify({
                    message: parseodata.mensaje.exito
                }, {
                    type: 'success',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    z_index: 10000,
                });
                location.reload(true);
            } else {
                $.notify({
                    message: parseodata.mensaje.error
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
                message: "Se ha producido un error"
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
