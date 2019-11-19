$(document).ready( function () {
    if(window.nombreXls === undefined){
        var data_export_prefix = "Museo";
    }else{
        var data_export_prefix = window.nombreXls;
    }
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        singleton: true,
        popout: true
    });

    $targets = [
        {'targets': 'unorderable', 'orderable': false},
        {'targets': 'orderable', 'orderable': true},
        {'targets': 'unsearchable', 'searchable': false}
    ];

    if($('table.painting-table').length) {
        $targets.push({'targets': 'active', 'visible': false, "searchable": false});
        $order = [[1, 'asc']];
    }

    $date = new Date();
    $today =($date.getDate()+ '-' + ($date.getMonth() + 1) + '-' +  $date.getFullYear());

    $('table.painting-table').DataTable(
        {
            'language': {'url':  window.location.origin+'/museum/public/resources/dataTables/dataTable-Spanish.json'},
            'dom': 'Blfrtip',
            'buttons': [
                'copyHtml5','pdfHtml5', 'csvHtml5',

                { extend: 'excelHtml5', text: '<span class="glyphicon glyphicon-download" aria-hidden="true"></span>' +
                ' Excel', filename: data_export_prefix+'_'+ $today, autoFilter: true,
                    exportOptions: {
                        format: {
                            body: function ( data, row, column, node ) {
                                // sacar html tags que pudieran haber en los datos
                                var html = $.parseHTML(data) ;
                                return $(html).text();
                            }
                        },
                        columns: '.exportable'
                    }
                }
            ],
            'searching': true,
            'columnDefs': [
                {'targets': 'unorderable', 'orderable': false},
                {'targets': 'orderable', 'orderable': true}
            ],

            "order": $order,
            "orderClasses" : false,
            "pageLength": 20
        }
    );
} );
