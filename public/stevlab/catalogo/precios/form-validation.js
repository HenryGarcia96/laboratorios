$(function() {
    'use strict';
    
    $.validator.setDefaults({
        submitHandler: function() {
            alert("submitted!");
        }
    });
    $(function() {
        // validate signup form on keyup and submit
        $("#formList").validate({
            rules: {
                descripcion: {
                    required: true,
                },
                descuento: {
                    required: true,
                }
            },
            messages: {
                descripcion: {
                    required: "Por favor ingrese alguna descripción",
                },
                descuento: {
                    required: "Ingrese algún valor",
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
            },
            submitHandler: function() {
                $.ajax({
                    url: '/catalogo/store-list',
                    type: 'POST',
                    data: $('#formList').serialize(),
                    success: function(response) {
                        console.log(response);

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
                        title: 'Lista guardada correctamente'
                        });
                        
                        // Reload
                        setTimeout(function(){
                            window.location.reload();
                        }, 3100);
                    }            
                });
            }
        });
    });
});