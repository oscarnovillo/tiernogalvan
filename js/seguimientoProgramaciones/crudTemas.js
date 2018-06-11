$(document).ready(function () {
    $("#aceptar_envio_tema").click(function () {
        fn_crear_tema();
    });
    $("#update_tema").click(function () {
        fn_update_unidad();
    });
    $("#borrar_unidad").click(function () {
        fn_borrar_unidad();
    });
});
function fn_crear_tema() {
    datos = JSON.stringify({
        "nombre": $("#nombre_tema").val(),
        "id_asignatura":$("#select_asignaturas_temas").val(),
        "evaluacion":$("#select_evaluacion").val()
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
                location.reload(true);
            } else {
                console.log(parseodata.error);
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
        'id': $("#nombre_asignatura_update").val(),
        'id_asignatura': $("#nombre_asignatura_update").attr("data-id"),
        'nombre': $("#select_cursos_asignaturas_edit").val()
    });
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&destino=unidades_trabajo&a=modificar",
        data: {'json_unidad': unidad},
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

function fn_borrar_unidad(){
    var unidad = JSON.stringify({
        'id_unidad':$("#nombre_unidad_update").attr("data-id")
    });
    $.ajax({
       url:"/index.php?c=seguimiento_programaciones&destino=unidades_trabajo&a=borrar",
       data:{'json_unidad':unidad},
       type:"POST",
       success: function(data){
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

function marcar_como_hecho_tema(){
    var estado = $(this).val();
    var tema = JSON.stringify({
        'id':$(this).attr("data-id"),
        'estado':estado
    });
    $.ajax({
        url:"/index.php?c=seguimiento_programaciones&destino=unidades_trabajo&a=modificar_estado_tema",
        data:{'json_unidades':tema},
        type:"POST",
        success: function(data){
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