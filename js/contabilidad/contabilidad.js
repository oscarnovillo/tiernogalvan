/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var maintenanceTable;

$(document).ready(function () {



    maintenanceTable = $('#contabilidad').DataTable({
        
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
//        "asStripClasses": [],
        "responsive": true,
      "pageLength": 20,
       "autoWidth": false,
       "info": false,
        "dom": 'lrtip',
         "footer": true,
        "footerOffset": 40,
        "order": [[1, "desc"], [0, "desc"]],
        "paging": false,
       "fixedColumns": true,
         initComplete: function () {
            this.api().column(0).every( function () {
                var column = this;
                
                var select = $('<select id="filtroDpto"></select>')
                    .appendTo( $("#filtro").empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            
            $("#filtroDpto").change();
            } );
        }
    });
    
});
