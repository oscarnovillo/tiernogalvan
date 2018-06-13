$(document).ready(function () {
    $("#aceptar_envio_tema").click(function () {
        fn_crear_tema();
    });
    $("#aceptar_tema_update").click(function () {
        fn_update_unidad();
    });
    $("#borrar_unidad").click(function () {
        fn_borrar_unidad();
    });
    $(".abrir-modal-update-tema").click(fn_mostrar_modal_upt_temas);
    $("#cambiar_estado_unidad").change(marcar_como_hecho_tema);
});
function fn_crear_tema() {
    datos = JSON.stringify({
        "nombre": $("#nombre_tema").val(),
        "id_asignatura": $("#select_asignaturas_temas").val(),
        "evaluacion": $("#select_evaluacion").val()
    });
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&destino=unidades_trabajo&a=insertar",
        type: "POST",
        data: {'json_unidad': datos},
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
                $("#addTema")[0].reset();
                $(".modal").hide();

                if ($("#select_asignaturas").val() != "" && $("#select_cursos").val() != "") {
                    cambiar_tabla_temas();
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


function fn_update_unidad() {

    var unidad = JSON.stringify({
        'id': $("#nombre_tema_update").attr("data-id"),
        'nombre': $("#nombre_tema_update").val(),
        'evaluacion': $("#select_evaluacion_update").val(),
        'comentario': $("#comentario_tema").val()
    });
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&destino=unidades_trabajo&a=modificar",
        data: {'json_unidad': unidad},
        type: "POST",
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
                $(".modal").hide();
                cambiar_tabla_temas();
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
function fn_borrar_unidad() {
    var unidad = JSON.stringify({
        'id_unidad': $("#nombre_tema_update").attr("data-id")
    });
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&destino=unidades_trabajo&a=borrar",
        data: {'json_unidad': unidad},
        type: "POST",
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
                $(".modal").hide();
                cambiar_tabla_temas();
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

function marcar_como_hecho_tema() {
    var estado = $(this).prop("checked");
    var tema = JSON.stringify({
        'id': $(this).attr("data-id"),
        'estado': estado
    });
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&destino=unidades_trabajo&a=modificar_estado_tema",
        data: {'json_unidad': tema},
        type: "POST",
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
                //location.reload(true);
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