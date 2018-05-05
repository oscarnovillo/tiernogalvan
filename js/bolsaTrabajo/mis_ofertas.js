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
                cambiarTextoRespuesta("#dialog_span", "Fallo eliminando la cuenta de base de datos");
                cambiarStatusAlert("#alert_type", "alert-warning");

            } else {

                var resp = JSON.parse(result);

                createAndLaunchModalView(resp);
            }


            console.log("Respuesta Server");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            cambiarTextoRespuesta("#dialog_span", "Tenemos problemas en el Servidor, inténtalo otra vez");
            cambiarStatusAlert("#alert_type", "alert-danger");
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
    var cabecera = genericObject.titulo;
    var okText = "OK";
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
            '<form class="" id="form_crear_oferta" action="">'+
                    '<h1 class="">Creación Oferta de trabajo</h1>'+
                '<p class="">Rellena los siguientes campos, para crear una nueva oferta de trabajo'+
                '<br></p>'+
                '<div class="input-group">'+
                    '<input type="hidden" class="form-control" name="action" required="required" value="crear_oferta_form"></div>'+
                    '<div class="form-group">'+
                    '<label class="">Título de la oferta *</label>'+
                '<input type="text" class="form-control" placeholder="Oferta de Trabajo" name="titulo_oferta" required="required">'+
                    '<small class="form-text text-muted">Describe en pocas palabras, lo que estas ofreciendo</small>'+
                '</div>'+
               '<div class="form-group">'+
                   '<label>Descripción</label>'+
                   '<small class="form-text text-muted">Cuentanos en que consiste el trabajo</small>'+
               '<textarea class="form-control" rows="4" name="descripcion_oferta"></textarea>'+
                   '</div>'+
                   '<div class="form-group">'+
                   '<label>Requisitos</label>'+
                   '<small class="form-text text-muted">Cuentanos un poco las habilidades necesarias que necesita el futuro candidato</small>'+
               '<textarea class="form-control" rows="4" name="requisitos_oferta"></textarea>'+
                   '</div>'+
                   '<div class="form-group">'+
                   '<label>Ciclo de Formación Profesional</label>'+
               '<select class="form-control" multiple="" required="required" name="fp_oferta">'+
                   '<option></option>'+
                   '<option>DAW - Desarrollo de Aplicaciones Web</option>'+
               '<option>ASIR -</option>'+
               '<option>4</option>'+
               '<option>5</option>'+
               '</select>'+
               '<small class="form-text text-muted">Tenemos distintos ciclos, seleciona el que mejor se ajuste a tu medida. Para selección múltiple presiona [Ctrl] y los ciclos que desees</small>'+
               '</div>'+
               '<div class="form-group">'+
                   '<label>Nombre de la Empresa</label>'+
               '<input type="text" class="form-control" placeholder="MiEmpresa SL" name="empresa_oferta">'+
                   '<small class="form-text text-muted">Queremos saber quien ofrece el empleo</small>'+
               '</div>'+
               '<div class="form-group">'+
                   '<label>web/información adicional</label>'+
               '<input type="text" class="form-control" placeholder="www.mi-empresa.es" name="web_oferta">'+
                   '<small class="form-text text-muted">Tienes una web? Quieres ofrecer más información? Has publicado esta oferta en otras plataformas? Dejanos el enlace</small>'+
               '</div>'+
               '<div class="form-group">'+
                   '<label>E-mail</label>'+
                   '<input type="email" class="form-control" placeholder="contacto@mi-empresa.es" name="email_oferta">'+
                   '<small class="form-text text-muted">Nuestros usuari@s estan interesados, escribe un e-mail donde contactarte.&nbsp;</small>'+
               '</div>'+
               '<div class="form-group">'+
                   '<label>Teléfono</label>'+
                   '<input type="text" class="form-control" placeholder="91123456" name="telefono_oferta">'+
                   '<small class="form-text text-muted">O si lo prefieres, puedes dejarnos un número de telefono</small>'+
               '</div>'+
               '<div class="form-group">'+
                   '<label>Vacantes</label>'+
                   '<input type="text" class="form-control" placeholder="10" name="vacante_oferta">'+
                   '<small class="form-text text-muted">Cuántos puestos de empleo, quieres ofrecer</small>'+
               '</div>'+
               '<div class="form-group">'+
                   '<label>Salario</label>'+
                   '<input type="text" class="form-control" placeholder="1000" name="salario_oferta">'+
                   '<small class="form-text text-muted">Cuál es el sueldo mensual, que quieres mostrar</small>'+
               '</div>'+
               '<div class="form-group">'+
                   '<label>Localización</label>'+
                   '<input type="text" class="form-control" placeholder="Madrid" name="localizacion_oferta">'+
                   '<small class="form-text text-muted">Dónde esta el centro de trabajo? Dinos la ciudad, barrio, calle o lugar apróximado</small>'+
               '</div>'+
               '<div class="form-group">'+
                   '<label>Caducidad</label>'+
                   '<input type="date" class="form-control" placeholder="20/01/2025" name="caducidad_oferta" required="required">'+
                   '<small class="form-text text-muted">Danos un plazo, hasta cuando deseas mostrar esta oferta en nuestra plataforma?</small>'+
               '</div>'+
               '<button type="submit" class="btn btn-primary btn-lg w-25 p-1">Crear Oferta</button>'+
           '</form>'+
        
        '<p>' + genericObject.cuerpo + '</p>' +
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