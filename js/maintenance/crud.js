$(document).ready(function () {
    $('#incidencias').DataTable({
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
        "order": [[ 0, "desc" ]]
    });
});