/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var maintenanceTable;
$(document).ready(function () {
    maintenanceTable = $('#contabilidad').DataTable({
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
        
        "fixedColumns": true
    });
    
});
