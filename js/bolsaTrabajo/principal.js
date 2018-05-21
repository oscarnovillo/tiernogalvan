let $form;
let dataForm;
var container;
$(document).ready(function () {

        updateSelection();
        crearContainer();

    }
);//fin ready


$("#form_filtrar_ofertas").submit(function (ev) {

    ev.preventDefault();
    container.pagination("destroy");
    updateSelection();
    crearContainer();


    //getOfertasFilter(data);

});

//TODO - pulir JS y modificar la vista principal - modificar la paginación - centrar y modificar controles
function crearContainer() {
    container = $('#pagination-demo2');
    container.pagination({
        dataSource: 'index.php?c=bolsa_trabajo&a=request_operation&operacion=pagination',
        locator: 'items',
        alias: {
            pageNumber: 'page',
            pageSize: 'limit'
        },
        totalNumber: 120,
        pageSize: 10,
        ajax: {
            beforeSend: function () {

                container.prev().html('Cargando Ofertas de trabajo ...');

            },
            data: {
                orden: dataForm.orden,
                fp_oferta: dataForm.fp_oferta
            }
        },
        callback: function (response, pagination) {
            window.console && console.log(22, response, pagination);
            var dataHtml = '<div class="list-group">';
            var estado = "active";
            var swt = 0;
            $.each(response, function (index, item) {

                if (swt % 2 == 0) {
                    estado = "";
                } else {
                    estado = "active";
                }
                dataHtml += '<a href="index.php?c=bolsa_trabajo&a=ver_oferta&id_oferta=' + item.ID_OFERTA + '"' +
                    '                               class="list-group-item list-group-item-action flex-column align-items-start ' + estado + '">' +
                    '                                <div class="d-flex w-100 justify-content-between">' +
                    '                                    <h5 class="mb-1">' + item.TITULO + '</h5>' +
                    '                                    <small>' + item.CREACION + '</small>' +
                    '                                </div>' +
                    '                                <p class="mb-1">' + item.DESCRIPCION + '</p>' +
                    '                            </a>';
                swt += 1;

            });
            dataHtml += '</div>';


            container.prev().html(dataHtml);
        }
    });
}

function updateSelection() {
    $form = $("#form_filtrar_ofertas");
    dataForm = getFormData($form);
    console.log(dataForm);
}

function getOfertasFilter(dataForm) {
    $.ajax({
        type: "GET",
        url: "index.php?c=bolsa_trabajo&a=request_operation",
        data: {
            operacion: "pagination",
            page: 1,
            limit: 1,
            orden: dataForm.orden,
            fp_oferta: dataForm.fp_oferta

        },
        success: function (result) {
            if (result === "null") {

            } else {

                var resp = JSON.parse(result);

                console.log(resp);
            }

            console.log("Respuesta Server");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });
}