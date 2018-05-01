$(document).ready(function () {
        $("#form_crear_oferta").submit(function (ev) {
            ev.preventDefault();
            var $form = $("#form_crear_oferta");
            var data = getFormData($form);
            enviarAlServidor(data);
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
            console.log(result);
        }
    });

}