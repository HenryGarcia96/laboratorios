'use strict';

$(function() {

    // validate signup form on keyup and submit
    $("#signupForm").validate({
        rules: {
            folio:{
                required: true,
            },
            numRegistro:{
                required: true,
            },
            id_paciente:{
                required: true,
            },
            id_empresa:{
                required: true,
            },
            servicio:{
                required: true,
            },
            tipoPaciente:{
                required: true,
            },
            turno:{
                required: true,
            },
            id_doctor:{
                required: true,
            },
            peso:{
                required: false,
            },
            talla:{
                required: false,
            },
            medicamento:{
                required: false,
            },
            diagnostico:{
                required: false,
            },
            observaciones:{
                required: false,
            },
            f_flebotomia:{
                required: true,
            },
            num_total:{
                required:true,
            },
            num_vuelo:{
                required:false,
            },
            pais_destino:{
                required:false,
            },
            aerolinea:{
                required:false,
            },
            numCama:{
                required:false,
            },
            h_flebotomia:{
                required:false,
            },
        },
        messages: {
            folio:{
                required:"Folio es requerido",
            },
            numRegistro:{
                required:"Numero de registro es requerido",
            },
            id_paciente:{
                required:"Paciente es requerido",
            },
            id_empresa:{
                required:"Empresa es requerida",
            },
            servicio:{
                required:"Servicio es requerida",
            },
            tipoPaciente:{
                required:"Tipo de paciente es requerido",
            },
            turno:{
                required:"Turno es requerido",
            },
            id_doctor:{
                required:"Doctor es requerido",
            },
            peso:{
                required:"Peso es requerido",
            },
            talla:{
                required:"Talla es requerido",
            },
            medicamento:{
                required:"Medicamento es requerido",
            },
            diagnostico:{
                required:"Diagnostico es requerido",
            },
            observaciones:{
                required:"Observaciones es requerido",
            },
            f_flebotomia:{
                required:"F. flebotomia es requerido",
            },
            num_vuelo:{
                required:"Numero de vuelo es requerido"
            },
            pais_destino:{
                required:"Pais destino es requerido"
            },
            aerolinea:{
                required:"Aerolinea es requerido"
            },
            h_flebotomia:{
                required:"H.Flebotomia es requerido"
            },
        },
        errorPlacement: function(error, element) {
            error.addClass( "invalid-feedback" );
            
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            }
            else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                error.insertAfter(element.parent().parent());
            }
            else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                error.appendTo(element.parent().parent());
            }
            else {
                error.insertAfter(element);
            }
        },
        highlight: function(element, errorClass) {
            if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
                $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
            }
        },
        unhighlight: function(element, errorClass) {
            if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
                $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
            }
        },
        submitHandler: function() {
            sendingAjax();
        }
    });
});
function checkProductos(){
    let lista = [];

    $('#listEstudios tr').each(function(){
        precio = precio + parseFloat($(this).find('td:eq(2)').text());
        // console.log($(this).find('td:eq(2)').text());
        lista.push('clave',$(this).find('th:eq(0)').text());
    });

    return lista;
}

function sendingAjax(){
	var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
    let lista = [];

    $('#listEstudios tr').each(function(){
        // precio = precio + parseFloat($(this).find('td:eq(2)').text());
        // console.log($(this).find('td:eq(2)').text());
        lista.push($(this).find('th:eq(0)').text());
    });
    console.log(lista);

    $.ajax({
        url: '/recepcion/guardar',
        type: 'POST',
        // beforeSend: function(){
        // },
        data: {
            _token: CSRF_TOKEN,
            data: $('#signupForm').serializeArray(),
            lista: lista,
        },
        success: function(response) {
            // Notificacion
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                
                Toast.fire({
                icon: 'success',
                title: 'Registro guardado'
                });
                // Reload
                setTimeout(function(){
                    window.location.reload();
                }, 2900);
            // signupForm
        }            
    });
}