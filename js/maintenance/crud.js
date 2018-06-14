var maintenanceTable;
$(document).ready(function () {
    maintenanceTable = $('#incidencias').DataTable({
        "lengthChange": false,
        "pagingType": "numbers",
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "asStripClasses": [],
        "responsive": true,
        "pageLength": 5,
        "bAutoWidth": true,
        "order": [[2, "desc"], [0, "desc"]],
        "initComplete": function (settings, json) {
            $("#incidencias_filter").find("label").contents().first()[0].textContent = '';
            $(maintenanceTable.table().container()).addClass('col-sm-12 col-lg-8');
            $(maintenanceTable.table().container()).find(".mdl-grid").eq(0).addClass('col-12');
            $(maintenanceTable.table().container()).find(".mdl-cell").eq(0).remove();
            $(maintenanceTable.table().container()).find(".mdl-cell").eq(0).addClass("col-12");
            $(maintenanceTable.table().container()).find(".mdl-cell").eq(0).find("input").attr("placeholder", "Introduce aquí tu búsqueda");

            $(maintenanceTable.table().container()).find(".mdl-grid").eq(1).addClass('col-12');
            $(maintenanceTable.table().container()).find(".mdl-grid").eq(2).addClass('col-12');
            $(maintenanceTable.table().container()).find("#incidencias_info").remove();
        },

        "aoColumnDefs": [
            {
                bSortable: false,
                aTargets: [ -1 ]
            }
        ],
        "fixedColumns": true
    });
    $("#Incidencias").click();
    $('textarea.incidencia').froalaEditor({
        placeholderText: 'Describe tu incidencia...'
    });
    $('textarea.chatComment').froalaEditor({
        placeholderText: 'Introduce aquí tu comentario... Pulsa enter para enviarlo.',
        enter: function() {console.log("enter!");}
    });
    $("textarea.incidencia.readonly").froalaEditor("edit.off");
});
$("#addIncidencia").submit(function( event ) {
    $('#sending-form').fadeIn(500);
});
$(".alert").on("click", function() { $(this).fadeOut(500)});