'use strict';

$(document).ready(function(){
    $('.consultaEstudios').change(function(){

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
        title: 'Estas cambiando los datos del formulario'
        });
    });
});