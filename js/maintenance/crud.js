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
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
        ],
        "pageLength": 5,
        "bAutoWidth": false,
        "order": [[3, "desc"], [0, "desc"]],
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
        }
    });
    $("#Incidencias").click();
});