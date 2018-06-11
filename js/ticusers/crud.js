var maintenanceTable;
$(document).ready(function () {
    maintenanceTable = $('#usuarios').DataTable({
        "lengthChange": false,
        "pagingType": "numbers",
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "asStripClasses": [],
        "responsive": true,
        "pageLength": 5,
        "bAutoWidth": false,
        "order": [[1, "asc"]],
        "initComplete": function (settings, json) {
            $("#usuarios_filter").find("label").contents().first()[0].textContent = '';
            $(maintenanceTable.table().container()).addClass('col-sm-12 col-lg-8');
            $(maintenanceTable.table().container()).find(".mdl-grid").eq(0).addClass('col-12');
            $(maintenanceTable.table().container()).find(".mdl-cell").eq(0).remove();
            $(maintenanceTable.table().container()).find(".mdl-cell").eq(0).addClass("col-12");
            $(maintenanceTable.table().container()).find(".mdl-cell").eq(0).find("input").attr("placeholder", "Introduce aquí tu búsqueda");

            $(maintenanceTable.table().container()).find(".mdl-grid").eq(1).addClass('col-12');
            $(maintenanceTable.table().container()).find(".mdl-grid").eq(2).addClass('col-12');
            $(maintenanceTable.table().container()).find("#usuarios_info").remove();
        }
    });
    $("#TIC_USERS").click();
});