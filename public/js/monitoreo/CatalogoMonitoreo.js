"use strict";
var Tabla = function() {

    $.fn.dataTable.Api.register('column().title()', function() {
        return $(this.header()).text().trim();
    });

    var initTable1 = function() {
        // begin first table
        var table = $('#kdatatable_programacion').DataTable({
            responsive: true,
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
                    <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 50],

            pageLength: 10,

            order: [[ 0, "desc" ]], //ordenamiento default
            language: {
                'lengthMenu': 'Display _MENU_',
                "url": $('#datatable_i18n').val()
            },

            processing: true,
            serverSide: true,
            ajax: {
                url:$('#programaciondatatable').val(),
                type:"POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    columnsDef: [
                        'id', 'folio', 'tipo_servicio', 'estatus_programacion','nombre_cliente', 'dom_origen', 'dom_destino', 'fecha_servicio' ,'acciones'],
                },

            },
            columns: [
                { data: 'id' },
                { data: 'folio' },
                { data: 'nombre_cliente' },
                { data: 'dom_origen' },
                { data: 'dom_destino' },
                { data: 'fecha_servicio' },
                { data: 'tipo_servicio' },
                { data: 'estatus_programacion' },
                {data: 'acciones', responsivePriority: -1},
            ],

            columnDefs: [
                {
                    width: '50px',
                    targets: -3,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        var status = {
                            0: {'title': 'Foraneo', 'class': 'label-outline-danger'},
                            1: {'title': 'Local', 'class': 'label-outline-warning'},
                        };
                        if (typeof status[full.tipo_servicio] === 'undefined') {
                            return data;
                        }
                        return '<span class="label font-weight-bold ' + status[full.tipo_servicio].class + ' label-inline" >' + status[full.tipo_servicio].title + '</span>';
                    },
                },
                {
                    width: '250px',
                    targets: -1,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var opt_ver = ``; var opt_edit = ``; var opt_desactivar =`` ; 
  
                           opt_ver =  `
                                <a href="" class="btn btn-sm btn-outline-success btn-icon mt-2" title="Ver programación" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="flaticon-eye"></i>
                                    </span>
                                </a>
                            `;

                           opt_edit =  `
                                <a href="" class="btn btn-sm btn-outline-success btn-icon mt-2" title="Editar programación" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="flaticon-edit"></i>
                                    </span>
                                </a>
                            `;
                        
                      


                        return opt_ver + opt_edit + opt_desactivar;

                    },
                }
            ],

            buttons: [
                {extend: "excel", className: "invisible"},
                {extend: "pdf", className: "invisible"},
                {extend: "csv", className: "invisible"},
                {extend: "print", className: "invisible"},

            ],

            "drawCallback": function(settings, json) {
                KTApp.initTooltips();
            }


        }).on( 'init.dt', function () {
        });

        $('#export-excel').on('click', function () {
            table.button(0).trigger();
        });
        $('#export-pdf').on('click', function () {
            table.button(1).trigger();
        });
        $('#export-csv').on('click', function () {
            table.button(2).trigger();
        });
        $('#export-print').on('click', function () {
            table.button(3).trigger();
        });

        var filter = function() {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
        };

        $('#kt_search').on('click', function(e) {
            e.preventDefault();
            var params = {};
            $('.datatable-input').each(function() {
                var i = $(this).data('col-index');
                if (params[i]) {
                    params[i] += '|' + $(this).val();
                }
                else {
                    params[i] = $(this).val();
                }
            });
            $.each(params, function(i, val) {
                table.column(i).search(val ? val : '', false, false);
            });
            table.table().draw();
        });

        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            $('.datatable-input').each(function() {
                $(this).val('');
                table.column($(this).data('col-index')).search('', false, false);
            });
            table.table().draw();
        });

    };

    return {

        //main function to initiate the module
        init: function() {
            initTable1();
        },

    };

}();

jQuery(document).ready(function() {
    Tabla.init();
});

