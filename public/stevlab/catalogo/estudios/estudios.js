$(function() {
    'use strict';
    
    $.validator.setDefaults({
        submitHandler: function() {
            console.log("submitted!");
        }
    });
    $(function() {
        // validate signup form on keyup and submit
        $("#registro_estudios").validate({
            rules: {
                clave: {
                    required: true,
                    minlength: 4
                },
                codigo: {
                    required: true,
                    minlength: 8
                },
                descripcion: {
                    required: true,
                    minlength: 8
                },
                area: {
                    required: true
                },
                muestra: {
                    required: true
                },
                recipiente: {
                    required: true
                },
                metodo: {
                    required: true
                },
                tecnica: {
                    required: true
                },
                equipo: {
                    required: true
                },
                condiciones: {
                    required: true,
                    minlength: 8
                },
                aplicaciones: {
                    required: true,
                    minlength: 8
                },
                dias: {
                    required: true,
                    minlength: 1
                },
            },
            messages: {
                clave:{
                    required: "Por favor ingrese clave.",
                    minlength: "Clave debe tener 4 carácteres mínimo."
                },
                codigo:{
                    required: "Por favor ingrese código.",
                    minlength: "Código debe tener 8 carácteres mínimo."
                },
                descripcion:{
                    required: "Por favor ingrese descripción.",
                    minlength:"Texto debe tener 8 carácteres minímo"
                },
                area: "Por favor selecciona área.",
                muestra:"Por favor elija muestra.",
                recipiente:"Por favor seleccione recipiente.",
                metodo:"Por favor seleccione método.",
                tecnica:"Por favor seleccione técnica.",
                equipo:"Por favor elija equipo.",
                condiciones:{
                    required: "Por favor ingrese condiciones.",
                    minlength:"Texto debe tener 8 carácteres minímo"
                },
                aplicaciones:{
                    required: "Por favor ingrese aplicaciones.",
                    minlength:"Texto debe tener 8 carácteres minímo"
                },
                dias:{
                    required: "Por favor ingrese dias.",
                    minlength:"Días debe tener 1 carácteres minímo"
                }
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
            }
        });
    });
});