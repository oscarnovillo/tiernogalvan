function editarOferta(idOferta) {
//llamada de AJAX -  para devolver datos de oferta creada por el/la usuari@

    $.ajax({
        type: "GET",
        url: "index.php?c=bolsa_trabajo&a=ver_oferta",
        data: {
            id_oferta: idOferta,
            response_json: true
        },
        success: function (result) {
            if (result === "null") {

            } else {

                var resp = JSON.parse(result);

                createAndLaunchModalView(resp);
                recuperarFpAsociadosOferta(idOferta);
            }


            console.log("Respuesta Server");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });

}

function recuperarFpAsociadosOferta(idOferta) {
    $.ajax({
        type: "GET",
        url: "index.php?c=bolsa_trabajo&a=request_operation",
        data: {
            operacion: "oferta_fp_codes",
            id_oferta: idOferta
        },
        success: function (result) {
            if (result === "null") {

            } else {

                var resp = JSON.parse(result);

                $('#fp_oferta').empty();
//                $('#fp_oferta').append($('<option>').text("Select"));
                $.each(resp.ESTUDIOS, function (i, obj) {
                    var marcado = false;
                    for (var i = 0; i < resp.KEYS.length && !marcado; i++) {
                        if (resp.KEYS[i].ID_FP == obj.ID_FP) {
                            marcado = true;
                        }
                    }

                    $('#fp_oferta').append($('<option>').text(obj.TITULO).attr({value: obj.ID_FP, selected: marcado}));

                });

                console.log(resp);
            }

            console.log("Respuesta Server");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });
}


function injectModalInPage(code) {
    $("#build_modal").html(code);

}

function createAndLaunchModalView(genericObject) {
    injectModalInPage(buildCodeModal(genericObject));
    $('#request_modal').modal('show');
}

//TODO - poblar con datos lo recibido del servidor
function buildCodeModal(genericObject) {
    var cabecera = "Editar Oferta de trabajo";
    var okText = "Guardar Cambios";
    var code = '<div class="modal fade" tabindex="-1" role="dialog" id="request_modal">' +
        '<div class="modal-dialog modal-lg" role="document">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<h5 class="modal-title">' + cabecera + '</h5>' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button>' +
        '</div>' +
        '<div class="modal-body">' +
        '<form class="" id="form_crear_oferta" action="">' +
        '<p class="">Edita toda la información que quieras, pero no te olvides en guardar los cambios' +
        '<br></p>' +
        '<div class="input-group">' +
        '<input type="hidden" class="form-control" name="action" required="required" value="crear_oferta_form"></div>' +
        '<div class="form-group">' +
        '<label class="">Título de la oferta *</label>' +
        '<input type="text" class="form-control" placeholder="Oferta de Trabajo" name="titulo_oferta" required="required" value="' + genericObject.TITULO + '">' +
        '<small class="form-text text-muted">Describe en pocas palabras, lo que estas ofreciendo</small>' +
        '</div>' +
        '<div class="form-group">' +
        '<label>Descripción</label>' +
        '<small class="form-text text-muted">Cuentanos en que consiste el trabajo</small>' +
        '<textarea class="form-control" rows="4" name="descripcion_oferta">' + genericObject.DESCRIPCION + '</textarea>' +
        '</div>' +
        '<div class="form-group">' +
        '<label>Requisitos</label>' +
        '<small class="form-text text-muted">Cuentanos un poco las habilidades necesarias que necesita el futuro candidato</small>' +
        '<textarea class="form-control" rows="4" name="requisitos_oferta">' + genericObject.REQUISITOS + '</textarea>' +
        '</div>' +
        '<div class="form-group">' +
        '<label>Ciclo de Formación Profesional</label>' +
        '<select class="form-control" multiple="" required="required" id ="fp_oferta" name="fp_oferta">' +

        '</select>' +
        '<small class="form-text text-muted">Tenemos distintos ciclos, seleciona el que mejor se ajuste a tu medida. Para selección múltiple presiona [Ctrl] y los ciclos que desees</small>' +
        '</div>' +
        '<div class="form-group">' +
        '<label>Nombre de la Empresa</label>' +
        '<input type="text" class="form-control" placeholder="MiEmpresa SL" name="empresa_oferta" value="' + genericObject.EMPRESA + '">' +
        '<small class="form-text text-muted">Queremos saber quien ofrece el empleo</small>' +
        '</div>' +
        '<div class="form-group">' +
        '<label>web/información adicional</label>' +
        '<input type="text" class="form-control" placeholder="www.mi-empresa.es" name="web_oferta" value="' + genericObject.WEB + '">' +
        '<small class="form-text text-muted">Tienes una web? Quieres ofrecer más información? Has publicado esta oferta en otras plataformas? Dejanos el enlace</small>' +
        '</div>' +
        '<div class="form-group">' +
        '<label>E-mail</label>' +
        '<input type="email" class="form-control" placeholder="contacto@mi-empresa.es" name="email_oferta" value="' + genericObject.EMAIL + '">' +
        '<small class="form-text text-muted">Nuestros usuari@s estan interesados, escribe un e-mail donde contactarte.&nbsp;</small>' +
        '</div>' +
        '<div class="form-group">' +
        '<label>Teléfono</label>' +
        '<input type="text" class="form-control" placeholder="91123456" name="telefono_oferta" value="' + genericObject.TELEFONO + '">' +
        '<small class="form-text text-muted">O si lo prefieres, puedes dejarnos un número de telefono</small>' +
        '</div>' +
        '<div class="form-group">' +
        '<label>Vacantes</label>' +
        '<input type="text" class="form-control" placeholder="10" name="vacante_oferta" value="' + genericObject.VACANTES + '">' +
        '<small class="form-text text-muted">Cuántos puestos de empleo, quieres ofrecer</small>' +
        '</div>' +
        '<div class="form-group">' +
        '<label>Salario</label>' +
        '<input type="text" class="form-control" placeholder="1000" name="salario_oferta" value="' + genericObject.SALARIO + '">' +
        '<small class="form-text text-muted">Cuál es el sueldo mensual, que quieres mostrar</small>' +
        '</div>' +
        '<div class="form-group">' +
        '<label>Localización</label>' +
        '<input type="text" class="form-control" placeholder="Madrid" name="localizacion_oferta" value="' + genericObject.LOCALIZACION + '">' +
        '<small class="form-text text-muted">Dónde esta el centro de trabajo? Dinos la ciudad, barrio, calle o lugar apróximado</small>' +
        '</div>' +
        '<div class="form-group">' +
        '<label>Caducidad</label>' +
        '<input type="date" class="form-control" placeholder="20/01/2025" name="caducidad_oferta" required="required" value="' + genericObject.CADUCIDAD + '">' +
        '<small class="form-text text-muted">Danos un plazo, hasta cuando deseas mostrar esta oferta en nuestra plataforma?</small>' +
        '</div>' +
        '</form>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>' +
        '<button type="button" class="btn btn-primary" data-dismiss="modal" id="ok_modal">' + okText + '</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';


    return code;
}