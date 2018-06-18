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
    $(".name_asignatura").click(fn_mostrar_modal_actualizar);
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
                $("#addAsignatura")[0].reset();
                $(".modal").hide();
                if ($("#select_cursos-g-a").val() != ""){
                    cambiar_tabla_asignaturas();
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
                cambiar_tabla_asignaturas();
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
            var parseodata = JSON.parse(data);
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
                $(".modal").hide();
                cambiar_tabla_asignaturas();
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
    $.ajax({
        url: "/index.php?c=seguimiento_programaciones&a=borrado_total&destino=asginaturas",
        data: {'json_asignatura': asignatura},
        type: "POST",
        success: function (data) {
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
                $(".modal").hide();
                cambiar_tabla_asignaturas();
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
                $(".modal").hide();
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
                $(".modal").hide();
        }
    });
}
function fn_mostrar_modal_crear(){
    $("#modal_aviso_nombre_asignatura").show();
}