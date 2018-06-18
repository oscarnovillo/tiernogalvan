var uploader = new qq.FineUploader({
    debug: false,
    element: document.getElementById('fine-uploader'),
    request: {
        endpoint: 'index.php?c=bolsa_trabajo&a=request_operation&operacion=upload_file'
    },
    deleteFile: {
        method: 'POST',
        enabled: true,
        endpoint: 'index.php?c=bolsa_trabajo&a=request_operation&operacion=upload_file'

    },
    retry: {
        enableAuto: true
    },
    validation: {
        itemLimit: 1,
        allowedExtensions: ["jpg", "png", "jpeg"]
    }
});


$(document).ready(function () {
        $("#form_editar_perfil").submit(function (ev) {
            ev.preventDefault();

            var data = getFormData($("#form_editar_perfil"));

            if (typeof uploader.getUploads('id')[0] !== 'undefined' && typeof uploader.getUploads('id')[0].name !== 'undefined') {
                var pos = data["NAME"] = uploader.getUploads('id').length - 1;
                data["NAME"] = uploader.getUploads('id')[pos].name;
                data["UUID"] = uploader.getUploads('id')[pos].uuid;

            }

            if (!$('button').is("[disabled]")) {//prevenir el doble click
                enviarAlServidor(data);
                $('button').attr('disabled', true);
            }
        });
        $("#form_configuraciones_adicionales").submit(function (ev) {
            ev.preventDefault();

            var data = getFormData($("#form_configuraciones_adicionales"));

            if (!$('button').is("[disabled]")) {//prevenir el doble click
                enviarAlServidorConfig(data);
                //$('button').attr('disabled', true);
            }
        });

    }
);


function enviarAlServidor(datos) {
    $.ajax({
        url: "index.php?c=bolsa_trabajo&a=editar_perfil&tarea=update",
        data: {
            editar_perfil: JSON.stringify(datos)
        },
        success: function (result) {
            $('button').attr('disabled', false);
            $("#build_modal_response").html(buildCodeModalMessage(JSON.parse(result)));
            $('#request_modal_response').modal('show');

            console.log(result);
        }, error: function (XMLHttpRequest, textStatus, errorThrown) {
            $('button').attr('disabled', false);
            $("#build_modal_response").html(buildCodeModalMessageError(JSON.parse(XMLHttpRequest.responseText)));
            $('#request_modal_response').modal('show');

            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });

}

function enviarAlServidorConfig(datos) {
    $.ajax({
        url: "index.php?c=bolsa_trabajo&a=editar_perfil&tarea=update",
        data: {
            editar_perfil_config: JSON.stringify(datos)
        },
        success: function (result) {
            $("#build_modal_response").html(buildCodeModalMessage(JSON.parse(result)));
            $('#request_modal_response').modal('show');
            $('#ver_perfil').hide();
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
    var irOferta = "Ver Perfil";
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
        '<a class="btn btn-primary" id="ver_perfil" href="' + genericObject.LINK + '" role="button">' + irOferta + '</a>' +
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
