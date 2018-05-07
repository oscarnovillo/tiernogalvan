$(document).ready(function(){
    $("#publicar").click(function(){
        $("#cont_form").slideToggle(350);
    });
    
    $("#form_venta").click(function(){
        $("#error_form").fadeOut(100);
    });
});

function validar(formulario){
    var valido = true;
    
    if(formulario.titulo.value == "" || !/[a-zA-Z]/.test(formulario.titulo.value)){
        valido = false;
        $("#error_form").html("Rellena todos los campos correctamente.");
        $("#error_form").fadeIn(100);
    }
    
    return valido;
}

