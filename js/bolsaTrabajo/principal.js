let $form;
let dataForm;
var container;
var numOfertas;
$(document).ready(function () {
        sizeOfertas();
        updateSelection();


    }
);//fin ready


$("#form_filtrar_ofertas").submit(function (ev) {

    ev.preventDefault();
    container.pagination("destroy");
    updateSelection();
    crearContainer();


});


function crearContainer() {
    container = $('#pagination');
    container.pagination({
        dataSource: 'index.php?c=bolsa_trabajo&a=request_operation&operacion=pagination',
        locator: 'items',
        alias: {
            pageNumber: 'page',
            pageSize: 'limit'
        },
        className: 'paginationjs-big',
        //totalNumber: 120,
        totalNumberLocator: function (response) {
            // you can return totalNumber by analyzing response content
            return numOfertas;
        },
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
                    '                                <p class="mb-1 dont-break-out">' + item.DESCRIPCION + '</p>' +
                    '                            </a>';
                swt += 1;

            });
            dataHtml += '</div>';

            container.prev().html(dataHtml);

        }
    });
}

function sizeOfertas() {
    $.ajax({
        type: "GET",
        url: "index.php?c=bolsa_trabajo&a=request_operation",
        data: {
            operacion: "size"
        },
        success: function (result) {
            var res = JSON.parse(result);
            numOfertas = res[0];

            crearContainer();//creamos el filtro cuando tenemos el total de ofertas

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest + textStatus + errorThrown);
        }
    });
}

function updateSelection() {
    $form = $("#form_filtrar_ofertas");
    dataForm = getFormData($form);
    console.log(dataForm);
}

