$(document).ready(function(){
    $("#form_venta").click(function(){
        $("#error_form").fadeOut(100);
    });
    
    setTimeout(function(){
        $(".error_reserva").fadeOut(100);
    }, 3000);
});

function verTodos(){
    $("#mios").slideUp(350);
    
    $("#cont_form").slideUp(350);
    
    setTimeout(function(){
        $("#texto_mios").removeClass("seleccionado");
        $("#texto_publicar").removeClass("seleccionado");
        
        $("#texto_todos").addClass("seleccionado");
        $("#todos").slideDown(350);
    }, 350);
}

function verMios(){
    $("#todos").slideUp(350);
    
    $("#cont_form").slideUp(350);
    
    setTimeout(function(){
        $("#texto_todos").removeClass("seleccionado");
        $("#texto_publicar").removeClass("seleccionado");
    
        $("#texto_mios").addClass("seleccionado");
        $("#mios").slideDown(350);
    }, 350);
}

function verPublicar(){
    $("#todos").slideUp(350);
    
    $("#mios").slideUp(350);
    
    setTimeout(function(){
        $("#texto_todos").removeClass("seleccionado");
        $("#texto_mios").removeClass("seleccionado");
        
        $("#texto_publicar").addClass("seleccionado");
        $("#cont_form").slideDown(350);
    }, 350);
}

function validar(formulario){
    var valido = true;
    
    if(formulario.titulo.value == "" || !/[a-zA-Z]/.test(formulario.titulo.value)){
        valido = false;
        $("#error_form").html("Rellena todos los campos correctamente.");
        $("#error_form").fadeIn(100);
    }
    
    return valido;
}

function reservar(id, id_vendedor){
    $("#id_venta").val(id);
    $("#id_vendedor").val(id_vendedor);
    $("#form_res").submit();
}

function editar(id, titulo, isbn, precio, asignatura, curso, estado){
    $("#id_venta_edit").val(id);
    $("#titulo_edit").val(titulo);
    $("#isbn_edit").val(isbn);
    $("#precio_edit").val(precio);
    $("#asignatura_edit").val(asignatura);
    $("#curso_edit").val(curso);
    $("#estado_edit").val(estado);
}
