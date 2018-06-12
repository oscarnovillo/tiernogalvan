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
    
    if(formulario.titulo.value == "" || !/[a-zA-Z0-9]/.test(formulario.titulo.value)){
        valido = false;
        $("#error_form").html("Rellena todos los campos correctamente.");
        $("#error_form").fadeIn(100);
    }
    
    return valido;
}

function reservar(id, id_vendedor, titulo){
    $("#id_venta").val(id);
    $("#id_vendedor").val(id_vendedor);
    $("#titulo_reserva").val(titulo);
    $("#form_res").submit();
}

function editar(id, titulo, isbn, precio, asignatura, curso, estado){
    $("#cont_form_edit").fadeIn(100);
    $("#id_venta_edit").val(id);
    $("#titulo_edit").val(titulo);
    $("#isbn_edit").val(isbn);
    $("#precio_edit").val(precio);
    $("#asignatura_edit").val(asignatura);
    $("#curso_edit").val(curso);
    $("#estado_edit").val(estado);
}

function eliminar(id){
    $("#id_venta_del").val(id);
    $("#form_eliminar").submit();
}

function cargarFiltro(asig, curso, orden){
    document.getElementById("asignatura_filtro").value = asig;
    document.getElementById("curso_filtro").value = curso;
    document.getElementById("orden_filtro").value = orden;
}

function resetFiltro(){
    document.getElementById("asignatura_filtro").value = 'cualquiera';
    document.getElementById("curso_filtro").value = 'cualquiera';
    document.getElementById("orden_filtro").value = 'fecha_publicacion';
}

function parametrosPag (numVentas) {
    $("#numPags").pagination({
        items: parseInt(numVentas),
        itemsOnPage: 5,
        cssStyle: 'light-theme',
        displayedPages: 3,
        hrefTextPrefix: '?c=venta_libros&filtro_asig=' + $("#asignatura_filtro").val() + '&filtro_curso=' + $("#curso_filtro").val() + '&orden=' + $("#orden_filtro").val() + '&page='
    });
}

function cambiarPag(numPag){
    $("#numPags").pagination('selectPage', parseInt(numPag));
}
