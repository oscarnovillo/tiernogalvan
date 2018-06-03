/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $("#abrir_modal_add_asignatura").click(function(){
        $("#modal_add_asignatura").show();
    })
    $(".close").click(function(){
        $("#modal_add_asignatura").hide();
    })
});

