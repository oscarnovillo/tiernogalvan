$(document).ready(function () {
        $("#form_crear_oferta").submit(function (ev) {
            ev.preventDefault();
            var $form = $("#form_crear_oferta");
            var data = getFormData($form);
            if (!$('button').is("[disabled]")) {//prevenir el doble click
                enviarAlServidor(data);
                $('button').attr('disabled', true);
            }
        });


    }
);

function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};
    var fp_ofertas = [];
    $.map(unindexed_array, function (n, i) {
        if (n["name"] === "fp_oferta") {
            fp_ofertas.push(n["value"]);
            indexed_array[n["name"]] = fp_ofertas;

        } else {
            indexed_array[n['name']] = n['value'];
        }

    });

    return indexed_array;
}


function enviarAlServidor(datos) {
    $.ajax({
        url: "index.php?c=bolsa_trabajo&a=crear_oferta&tarea=insert",
        data: {
            nueva_oferta: JSON.stringify(datos)
        },
        success: function (result) {
            $("#build_modal_response").html(buildCodeModalMessage(JSON.parse(result)));
            $('#request_modal_response').modal('show');
            $('button').attr('disabled', false);
            console.log(result);
        }, error: function (XMLHttpRequest, textStatus, errorThrown) {
            $("#build_modal_response").html(buildCodeModalMessageError(JSON.parse(XMLHttpRequest.responseText)));
            $('#request_modal_response').modal('show');
            $('button').attr('disabled', false);
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });

}

function buildCodeModalMessage(genericObject) {
    var cabecera = genericObject.TITULO;
    var okText = "Entendido";
    var irOferta = "Ver Oferta Creada";
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
        '<a class="btn btn-primary" href="' + genericObject.LINK + '" role="button">' + irOferta + '</a>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';


    return code;
}

function buildCodeModalMessageError(genericObject) {
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