"use strict";
var Tabla = function() {

    $.fn.dataTable.Api.register('column().title()', function() {
        return $(this.header()).text().trim();
    });

    var initTable1 = function() {
        // begin first table
        var table = $('#kdatatable_tarifario').DataTable({
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
                url:$('#tarifariodatatable').val(),
                type:"POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    columnsDef: [
                        'id', 'nombre_cliente',  'origen', 'destino', 'kms', 'ppkm_sis', 'ppkm_cust', 'caseta', 'permisos' ,'acciones'],
                },

            },
            columns: [
                { data: 'id' },
                { data: 'origen' },
                { data: 'destino' },
                { data: 'nombre_cliente' },
                { data: 'caseta' },
                { data: 'kms' },
                { data: 'ppkm_sis' },
                { data: 'ppkm_cust' },
                {data: 'acciones', responsivePriority: -1},
            ],

            columnDefs: [
                {
                    targets: -1,
                    title: 'Acciones',
                    orderable: false,
                    render: function(data, type, full, meta) {

                           return `
                                <a href="/tarifario/ver-tarifario/`+full.id+`" class="btn btn-sm btn-outline-success btn-icon mr-2" title="Ver tarifario" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="flaticon-eye"></i>
                                    </span>
                                </a>
                                <a href="/tarifario/editar-tarifario/`+full.id+`" class="btn btn-sm btn-outline-success btn-icon mr-2" title="Editar tarifario" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="flaticon-edit"></i>
                                    </span>
                                </a>
                                <button class="btn btn-clean btn-sm btn-icon btn-outline-success mt-1" onClick="deletetarifario(`+ full.id +`,`+full.id+`)" data-toggle="modal" data-target="#model_delete_user" data-toggle="tooltip" data-theme="dark" title="Desactivar tarifario">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="flaticon-delete"></i>
                                    </span>
                                 </button>
                            `;
                        
                    },
                }

            ],

            buttons: [
                {extend: "excel", className: "invisible"},
                {extend: "pdf", className: "invisible"},
                {extend: "csv", className: "invisible"},
                {extend: "print", className: "invisible"},

            ],

        }).on( 'init.dt', function () {
            KTApp.initTooltips();
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


    function deletetarifario(nombre, id) {
        Swal.fire({
            title: "Estas seguro de desactivar el registro "+nombre,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Desactivarlo!",
            cancelButtonText: "No, Cancelar!",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                document.getElementById("id_tarifario_delete").value = id;
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Espere un momento, la información esta siendo procesada",
                    showConfirmButton: false
                });
                document.getElementById("tarifario_delete_form").submit();
            } else if (result.dismiss === "cancel") {
                Swal.fire(
                    "Cancelada",
                    "La acción fue cancelada",
                    "error"
                )
            }
        });

    }



    $("#kdatatable_tarifas_inactivos").DataTable({
        language: {
            'lengthMenu': 'Display _MENU_',
            "url": $('#datatable_i18n').val()
        },

        "dom":
        "<'row'" +
        "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
        "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
        ">" +

        "<'table-responsive'tr>" +

        "<'row'" +
        "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
        "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
        ">"
    });


    $(".activar-tarifa").click(function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre');

        Swal.fire({
            title: "Estas seguro de activar el registro "+nombre,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Activarlo!",
            cancelButtonText: "No, Cancelar!",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                document.getElementById("id_delete").value = id;
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Espere un momento, la información esta siendo procesada",
                    showConfirmButton: false
                });
                document.getElementById("tarifario_act_form").submit();
            } else if (result.dismiss === "cancel") {
                Swal.fire(
                    "Cancelada",
                    "La acción fue cancelada",
                    "error"
                )
            }
        });
    });