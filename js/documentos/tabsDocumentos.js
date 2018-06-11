/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $('.tablinks').on("click",openAdmin);
    
   
    $("#defaultModalDocumento").click();
    $("#defaultModalCategoria").click();
    $("#defaultOpen").click();
});
function openAdmin() {
    // Declare all variables

    // Se ocultan todos los tabelements donde se mostrara el ciontenido de los tabs
    $(".tabcontent").each(function( index ) {
        $(this).css('display','none');
    });
   
    // Se elimina la clase "active" de los botones de eleccion de tabs
    $(".tablinks").each(function( index ) {
        $(this).removeClass('active');
    });

    // Pine el tabcontent que se pide mostrar como display block, el botonque  ha seleccionado el usuario a activo y un border en el tabcontent
    var elemento = "#" + $(this).attr('data-element');
    $(elemento).css('display','block');
    $(elemento).css('border','0.3px solid #ccc');
    
    $(this).addClass(' active');
    
}
