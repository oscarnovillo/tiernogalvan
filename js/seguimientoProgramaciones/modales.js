/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $("#abrir_modal_add_asignatura").click(function(){
        $("#modal_add_asignatura").show();
        $("#modal_aviso_nombre_asignatura").show();
    });
    $("#entendido").click(function(){
        $("#modal_aviso_nombre_asignatura").hide();
    })
    $("#abrir_modal_add_tema").click(function(){
        $("#modal_add_tema").show();
    })
    $(".close").click(function(){
        $("#modal_add_asignatura").hide();
        $("#modal_add_tema").hide();
    });
});

