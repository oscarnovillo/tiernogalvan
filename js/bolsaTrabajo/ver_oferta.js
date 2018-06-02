$(document).ready(function () {
        $("#id_apuntarse").click(function (ev) {
            ev.preventDefault();

            var data = $("#id_oferta").val();


            if (!$('a').is("[disabled]")) {//prevenir el doble click
                enviarAlServidor(data);
                $('a').attr('disabled', true);
            }
        });

    }
);


function enviarAlServidor(datos) {
    $.ajax({
        url: "index.php?c=bolsa_trabajo&a=request_operation&operacion=apuntar_oferta",
        data: {
            id_oferta: datos
        },
        success: function (result) {
            $("#build_modal_response").html(buildCodeModalMessage(JSON.parse(result)));
            $('#request_modal_response').modal('show');
            $('a').attr('disabled', false);
            console.log(result);
        }, error: function (XMLHttpRequest, textStatus, errorThrown) {
            $("#build_modal_response").html(buildCodeModalMessage(JSON.parse(XMLHttpRequest.responseText)));
            $('#request_modal_response').modal('show');
            $('a').attr('disabled', false);
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });

}

function buildCodeModalMessage(genericObject) {
    var cabecera = genericObject.TITULO;
    var okText = "Entendido";

    var code = '<div class="modal fade"  id="request_modal_response">' +
        '<div class="modal-dialog" role="dialog">' +
        '<div class="modal-content">' +
        '<div class="modal-header" >' +
        '<h5 class="modal-title">' + cabecera + '</h5>' +
        '<button type="button" class="close" data-dismiss="modal">' +
        '<span>×</span>' +
        '</button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<p>' + genericObject.TEXTO + '</p>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-secondary" data-dismiss="modal">' + okText + '</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';


    return code;
}

