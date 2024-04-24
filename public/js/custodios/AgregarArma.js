"use strict";
var Modulo = function() {

    var lista = ''; //lista de elementos
    var contadorDocumentos=0; //indice contador de elementos
    var contadorFotografia = 0;
    var validador; //validador del formulario

    var validacion = function() {
        //validacion de formulario
        const form = document.getElementById('submit_vehiculo');
        validador = FormValidation.formValidation(
            form,
            {
                locale: 'es_ES',
                localization: FormValidation.locales.es_ES,
                fields: {

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    declarative: new FormValidation.plugins.Declarative({
                        html5Input: true,
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        //	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
                        //	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
                    })
                }
            }
        ).on('core.form.valid', function() {
            toastr.success("Guardando, Por favor Espere...");
        }).on('core.form.invalid', function() {
            toastr.warning("Por favor, Ingrese la información marcada en rojo.");
            KTUtil.scrollTop();
        });

        $( "#btnGuardar" ).click(function( e ) {
            e.preventDefault();
            validador.validate().then(function(status) {
                if (status === 'Valid'){
                    var btnGuardar = document.getElementById('btnGuardar');
                    KTUtil.btnWait( btnGuardar, 'spinner spinner-right spinner-white pr-15', 'Espere...', true);
                    form.submit();
                }
            });
        });
    };

    var initEvents = function() {

        var arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }

        $("#vigencia_portacion").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        lista = construyeElementosLista();
        //botón agregar otro archivo
        $( ".hrefAgregarOtro" ).on( "click", function(event) {
            event.preventDefault();
            addArchivo();
        });
        delArchivo();

        $( ".hrefAgregarOtroF" ).on( "click", function(event) {
            event.preventDefault();
            addArchivoF();
        });
        delArchivoF();


    };

    //construye  elementos de la lista
    var construyeElementosLista = function () {
        var tipoArchivo = $("#tipoArchivo").val();
        var colTipoArchivo = JSON.parse(tipoArchivo);
        var opcion ="";

        $.each(colTipoArchivo, function(i, item) {
            opcion += "<option value='"+i+"' >"+item+"</option>";
        });

        return opcion;
    };

    //validador de elementos agregados para archivo
    const archivoValidador = {
        validators: {
            notEmpty: {
                message: 'Por favor introduce un valor',
            },
            file: {
                extension: 'jpeg,jpg,png,pdf,docx,xls,gif,ppt,bmp',
                type: 'image/jpeg,image/png,application/pdf,application/msword,application/vnd.ms-excel,image/gif,application/vnd.ms-powerpoint,image/x-ms-bmp',
                message: 'Por favor ingrese un archivo válido, solo se permite imágenes, archivos de office y PDF',
            },
        },
    };

    //validador de elementos agregados para archivo
    const tipoArchivoValidador = {
        validators: {
            notEmpty: {
                message: 'Por favor introduce un valor',
            },
        },
    };

    //agrega el elemento archivo y lista desplegable
    var addArchivo = function () {
        contadorDocumentos++;
        var html = '';
        html += ([    "",
            "<tr id='trDocumento"+contadorDocumentos+"'>",
            "    <td>",
            "        <div class='form-group mb-0'>",
            "           <div class='custom-file'>",
            "               <input type='file' class='custom-file-input' id='archivo"+contadorDocumentos+"' name='archivo["+contadorDocumentos+"]' required />",
            "               <label class='custom-file-label' for='archivo"+contadorDocumentos+"'>Selecciona un archivo</label>",
            "           </div>",
            "        </div>",
            "    </td>",
            "    <td>" +
            "       <div class='form-group mb-0'>" +
            "          <select class='form-control' name='id_documento["+contadorDocumentos+"]' id='id_documento"+contadorDocumentos+"' required>",
            "              <option value=''>Selecciona un opción</option>",
            lista,
            "          </select>",
            "       </div>" +
            "    </td>",
            "	 <td>",
            "		<a href='#' class='btn btn-clean btn-icon btn-outline-success mt-1 hrefEliminar' data-id='"+contadorDocumentos+"' data-toggle='tooltip' data-theme='dark' title='Eliminar'>",
            "			<i class='flaticon-delete'></i>",
            "		</a>",
            "	 </td>",
            "</tr>",

            ""].join(""));
        $("#tblDocumentos tbody").append(html); //agrega el html creado
        //agrega validación del elemento creado
        validador.addField('archivo[' + contadorDocumentos + ']', archivoValidador);
        validador.addField('id_documento[' + contadorDocumentos + ']', tipoArchivoValidador);
        KTApp.initTooltips(); //inicia tooltip del elemento creado
        KTApp.initFileInput(); //inicia el elemento archivo del elemento creado
    };

    //elimina un elemento
    var delArchivo = function () {
        jQuery(document).on("click", ".hrefEliminar" , function(e) {
            e.preventDefault();
            var idDocumento = $(this).attr("data-id"); //indice del elemento
            KTApp.hideTooltips(); //oculta tooltip
            //elimina la validación del elemento
            validador.removeField('archivo[' + idDocumento + ']');
            validador.removeField('id_documento[' + idDocumento + ']');
            $('#trDocumento'+idDocumento).remove();//elimina el elemento
        });
    };


    //agrega el elemento archivo y lista desplegable
    var addArchivoF = function () {
        contadorFotografia++;
        var html = '';
        html += ([    "",
            "<tr id='trDocumentoF"+contadorFotografia+"'>",
            "    <td>",
            "        <div class='form-group mb-0'>",
            "           <div class='custom-file'>",
            "               <input type='file' class='custom-file-input' id='foto"+contadorFotografia+"' name='foto["+contadorFotografia+"]' required />",
            "               <label class='custom-file-label' for='foto"+contadorFotografia+"'>Selecciona un archivo</label>",
            "           </div>",
            "        </div>",
            "    </td>",
            "    <td>",
            "       <a href='#' class='btn btn-clean btn-icon btn-outline-success mt-1 hrefEliminarF' data-id='"+contadorFotografia+"' data-toggle='tooltip' data-theme='dark' title='Eliminar'>",
            "           <i class='flaticon-delete'></i>",
            "       </a>",
            "    </td>",
            "</tr>",

            ""].join(""));
        $("#tblDocumentosF tbody").append(html); //agrega el html creado
        //agrega validación del elemento creado
        validador.addField('foto[' + contadorFotografia + ']', archivoValidador);
        validador.addField('id_foto[' + contadorFotografia + ']', tipoArchivoValidador);
        KTApp.initTooltips(); //inicia tooltip del elemento creado
        KTApp.initFileInput(); //inicia el elemento archivo del elemento creado
    };

    //elimina un elemento
    var delArchivoF = function () {
        jQuery(document).on("click", ".hrefEliminarF" , function(e) {
            e.preventDefault();
            var idDocumento = $(this).attr("data-id"); //indice del elemento
            KTApp.hideTooltips(); //oculta tooltip
            //elimina la validación del elemento
            validador.removeField('foto[' + idDocumento + ']');
            validador.removeField('id_foto[' + idDocumento + ']');
            $('#trDocumentoF'+idDocumento).remove();//elimina el elemento
        });
    };


    var eventosEspeciales = function () {
        $('#elemento1').val();
    };

    return {

        //main function to initiate the module
        init: function() {
            initEvents();
            validacion();
            eventosEspeciales();
        },

    };

}();

jQuery(document).ready(function() {
    Modulo.init();
});

$("#tp2").click(function(){
    $(".div_patio").show();
    $(".div_contrato").hide();
});

$("#tp1").click(function(){
    $(".div_patio").hide();
    $(".div_contrato").show();
});