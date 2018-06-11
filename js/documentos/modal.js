/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var modalTarget;
var modalObject;
$(document).ready(function(){
  
    $('.open-modal').on('click', function(){
        var modal  = "#"+$(this).attr('data-modal-target');
        modalObject = document.getElementById($(this).attr('data-modal-target'));
        $(modal).show();
        if(modal=="#mantener-documentos")
            $("#defaultModalDoc").click();
        else if(modal=="#mantener-categorias")
            $("#defaultModalCategoria").click();
    });
    
    $('.close-modal').on('click', function(){
        var modal = "#"+ $(this).attr('data-modal');
        $(modal).css('display', 'none');
        $("#defaultOpen").click();
    });
    
   
});

window.onclick = function(event) {
    if (event.target == modalObject) {
        modalObject.style.display = "none";
        $("#defaultOpen").click();
    }
}
 
        

