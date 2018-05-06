function mostrar_mensaje(tipo, texto){
    $("#mensaje").hide();
    $("#mensaje").attr('class','mensaje_'+tipo);
    $("#mensaje").html(texto);
    $("#mensaje").fadeIn(500);
    /*$("#mensaje").delay(4000);
    $("#mensaje").fadeOut(1000);*/
} 

function borrar(id){
    var borrar_tarea = confirm("¿Seguro que desea borrar esta tarea?");
    if (borrar_tarea){      
//            $.ajax({
//                type: 'post',
//                url: 'URL_DE_BORRAR_TAREA',
//                method: 'POST',
//                data: {
//                    'id': id,
//                },
//                success: function (response) {
                    $("#fila_tarea"+id).fadeOut(500);  
                    mostrar_mensaje("ok", "Se ha eliminado satisfactoriamente la tarea '" + $("#descripcion"+id).val()+"'");
//                },
//                error: function (response) {
//                    mostrar_mensaje("error", "Fallo en la operación");
//                }
//            });


        mostrar_mensaje("ok", $("#mensaje").html()+" (mentira, no estoy conectando a la BBDD)");
         
    } else {
        mostrar_mensaje("aviso", "Se ha cancelado la operación");
    }
}

/* Campos*/
function comprobar_cambio(campo, id){
    if ($("#"+campo+id).val() != $("#"+campo+"_original"+id).val()){
        $("#btns_"+campo+""+id).show();       
    } else {
        $("#btns_"+campo+""+id).hide();
    }
}

function modificar_campo (campo, id){
    original = $('#'+campo+"_original"+id).val();
    nuevo = $('#'+campo+id).val();
    if (nuevo != original){
        if (nuevo != ''){
            var editar_tarea = confirm("¿Seguro que desea modificar este campo?"+
                    "\nDe: " +"\""+original+"\""+
                    "\nA: " + "\""+nuevo+"\"");
            
            if (editar_tarea){

    //                $.ajax({
    //                    type: 'post',
    //                    url: 'URL_DE_MODIFICAR_TAREA',
    //                    method: 'POST',
    //                    data: {
    //                        'id': id,
    //                        'campo': campo,
    //                        'nuevo': nuevo,
    //                    },
    //                    success: function (response) {
                            $("#"+campo+"_original"+id).val($("#"+campo+id).val())
                            mostrar_mensaje("ok", "Se ha modificado el campo [" + campo + "] de la tarea [" + id + "] a: '" + nuevo+"'");
                            $("#btns_"+campo+id).hide();
    //                    },
    //                    error: function (response) {
    //                        mostrar_mensaje("error", "Fallo en la operación");
    //                    }
    //                });

            mostrar_mensaje("ok", $("#mensaje").html()+" (mentira, no estoy conectando a la BBDD)");

            } else {
                mostrar_mensaje("aviso", "Se ha cancelado la operación");
                restaurar_campo(campo, id)
            }
        } else {
            mostrar_mensaje("aviso", "El campo no puede ser nulo");
        }
    }

}

function restaurar_campo (campo, id){
    $("#"+campo+id).val($("#"+campo+"_original"+id).val())
    $("#btns_"+campo+id).hide();
}

function restaurar_campo_si_vacio (campo, id){
    if ($("#"+campo+id).val()==''){
        $("#"+campo+id).val($("#"+campo+"_original"+id).val())
        $("#btns_"+campo+id).hide();
    }
}


function enviarEnter(e, campo, id) {
    if (e.keyCode == 13) {              // Enter. Aceptar
        modificar_campo (campo, id);
    } else if (e.keyCode == 27) {       // Escape. Cancelar
        restaurar_campo (campo, id);
    }
}