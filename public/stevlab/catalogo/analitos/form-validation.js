$(function() {
    'use strict';
    
    // $.validator.setDefaults({
    // });
    $(function() {
        // validate signup form on keyup and submit
        $("#regisAnalito").validate({
            rules: {
                clave:{
                    required: true,
                    minlength:4
                },
                descripcion:  'required',
                bitacora:     'required',
                defecto:      'required',
                unidad:       'required',
                digito:       'required',
                tipo_resultado:'required',
            },
            messages: {
                clave: {
                    required: "Ingrese clave.",
                    minlength: "Debe ingresar al menos 4 caracteres."
                },
                descripcion:    'Ingrese descripción.',
                bitacora:       'Ingrese dato de bitacora.',
                defecto:        'Ingrese valor por defecto.',
                unidad:         'Ingrese unidad de medida.',
                digito:         'Ingrese digitos.',
                tipo_resultado:  'Seleccione tipo de resultado',
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
                $.ajax({
                    url: '/catalogo/store-analito',
                    type: 'POST',
                    data: $('#regisAnalito').serialize(),
                    success: function(response) {
                        console.log(response);
                        
                        if(response.tipo_resultado == "referencia"){
                            let  value = `<input type="hidden" name="analito" value="${response.id}">`;
                            $('#modalReferencia').modal('show');
                            $('#referenciaAnalito').append(value);
                        }
    
                        $('#modalAnalito').modal('hide');
    
                    }            
                });
            }
        });
    });

    // Para los valores de referencia de los analitos
    $(function() {
        // validate signup form on keyup and submit
        $("#referenciaAnalito").validate({
            rules: {
                edad_inicial: 'required',
                tipo_inicial: 'required',
                edad_final: 'required',
                tipo_final: 'required',
                sexo:{
                    required: true,
                },
                referencia_inicial:'required',
                referencia_final:'required',
            },
            messages: {
                edad_inicial: 'Ingrese edad inicial de referencia.',
                tipo_inicial: 'Seleccione tipo.',
                edad_final: 'Ingrese edad final de referencia.',
                tipo_final: 'Seleccione tipo.',
                sexo: 'Seleccione sexo.',
                referencia_inicial: 'Ingrese valor de referencia inicial.',
                referencia_final: 'Ingrese valor de referencia final.',
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
                    $(element).addClass( "is-valid" ).removeClass( "is-invalid" );
                }
            },
            submitHandler: function() {
                $.ajax({
                    url: '/catalogo/store-referencia',
                    type: 'POST',
                    data: $('#referenciaAnalito').serialize(),
                    success: function(response) {
                        console.log(response);
                        let data = `
                                    <tr>
                                        <th>${response.edad_inicial}</th>
                                        <th>${response.tipo_inicial}</th>
                                        <th>${response.edad_final}</th>
                                        <th>${response.tipo_final}</th>
                                        <th>${response.sexo}</th>
                                        <th>${response.referencia_inicial}</th>
                                        <th>${response.referencia_final}</th>
                                        <th>dias1</th>
                                        <th>dias2</th>
                                        <th>Buttons</th>
                                    </tr>
                                `;
                        $('#valoresReferencias').append(data);
                    }            
                });
            }
        });
    });
});