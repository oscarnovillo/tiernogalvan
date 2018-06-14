var modal_addIncidencia = $('#agregarIncidencia'),
modal_markAs = $('#markAs'),
modal_delete = $('#delete'),
modal_details = $('#details'),
modal_chat = $('#chat');

/*
* Modal de agregar incidencia.
 */
$(".close-modal").on("click", function() {
    modal_addIncidencia.hide();
    modal_markAs.hide();
});
$(window).on("click",function(event) {
    if ($(event.target).attr('id') == modal_addIncidencia.attr('id')) {
        modal_addIncidencia.hide();
    }
});

if (urlParam("op") == "add") {
    modal_addIncidencia.show();
}

/*
* Modal de marcar como.
 */
$(".openMarkAs").on("click", function() {
    modal_markAs.show();
    var idIncidencia = $(this).attr("data-inc-id");
    $("#markAsCompleted").on("click", function () { window.location = baseMarkAsUrl.replace("_processName","completado").replace("_idIncidencia",idIncidencia)});
    $("#markAsProcess").on("click", function () { window.location = baseMarkAsUrl.replace("_processName","proceso").replace("_idIncidencia",idIncidencia)});
    $("#markAsAwaiting").on("click", function () { window.location = baseMarkAsUrl.replace("_processName","sinempezar").replace("_idIncidencia",idIncidencia)});
});
$(window).on("click",function(event) {
    if ($(event.target).attr('id') == modal_markAs.attr('id')) {
        modal_markAs.hide();
    }
});
/*
* Modal de confirmación de eliminación.
 */
$(".openDelete").on("click", function() {
    modal_delete.show();
    var idIncidencia = $(this).attr("data-inc-id");
    $("#cancelDelete").on("click", function () { modal_delete.hide(); });
    $("#goDelete").on("click", function () { window.location = deleteUrl.replace("_idIncidencia",idIncidencia)});
});
$(window).on("click",function(event) {
    if ($(event.target).attr('id') == modal_delete.attr('id')) {
        modal_delete.hide();
    }
});

/*
* Modal de visualización de detalles.
 */
$(".openDetails").on("click", function() {
    modal_details.show();
    var equipoIncidencia = $(this).attr("data-inc-equipo"),
    lugarIncidencia = $(this).attr("data-inc-lugar"),
    textoIncidencia = $(this).attr("data-inc-texto"),
    solicitanteIncidencia = $(this).attr("data-inc-solicitante"),
    departamentoIncidencia = $(this).attr("data-inc-departamento");
    $("#details").find("input[name='equipo']").val(equipoIncidencia).attr("readonly",true);
    $("#details").find("input[name='lugar']").val(lugarIncidencia).attr("readonly",true);
    console.log(textoIncidencia);
    $("#details").find("textarea[name='texto']").froalaEditor('html.set', textoIncidencia);
    $("#details").find("input[name='solicitante']").val(solicitanteIncidencia).attr("readonly",true);
    $("#details").find("select[name='departamento']").find("option:contains('" + departamentoIncidencia + "')").prop('selected', true);
    $("#details").find("select[name='departamento']").attr("disabled",true);
});
$(window).on("click",function(event) {
    if ($(event.target).attr('id') == modal_details.attr('id')) {
        modal_details.hide();
    }
});

/*
* Chat entre usuario y TIC.
 */
var myMessage = `<div class="talk-bubble tri-right right-in">
                                    <div class="talktext">
                                        <b>__USERNAME</b>
                                        <p>__MESSAGE</p>
                                    </div>
                                </div>`,
    othersMessage = `<div class="talk-bubble tri-right left-in">
                                <div class="talktext">
                                        <b>__USERNAME</b>
                                    <p>__MESSAGE</p>
                                </div>
                            </div>`;
$(".openChat").on("click", function() {
    modal_chat.show();
    var idIncidencia = $(this).attr("data-inc-id"),
    textoIncidencia = $(this).attr("data-inc-texto");
    $("#textoIncidenciaChat").html(textoIncidencia);
    $("#mensajesChat").html();
    mensajes.forEach(function(mensaje) {
        if(mensaje.incidencia_id == idIncidencia)
        {
            if(mensaje.user_id == actualUserId)
            {
                $("#mensajesChat").append(myMessage.replace("__MESSAGE",mensaje.mensaje).replace("__USERNAME",mensaje.username));
            }
            else
            {
                $("#mensajesChat").append(othersMessage.replace("__MESSAGE",mensaje.mensaje).replace("__USERNAME",mensaje.username));
            }
        }
    });
    $('textarea.chatComment').froalaEditor('events.on', 'keydown', (e) => {
        if(e.keyCode == 13) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            window.location = addCommentChatUrl.replace("_idIncidencia",idIncidencia).replace("_comment",$('textarea.chatComment').froalaEditor('html.get'));
            return false;
        }
    }, true);
});
$(window).on("click",function(event) {
    if ($(event.target).attr('id') == modal_chat.attr('id')) {
        modal_chat.hide();
    }
});