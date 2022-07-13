'use strict';

$(document).ready(function(){
    $('.datepicker').datepicker();

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
        title: 'Actualizando busqueda'
        });
    });

    // $('.js-example-basic-single').select2();
    var table = $('#dataTableMetodos').DataTable();


    table.on( 'click', 'tr' ,function () {
        var valores =[];
        $(this).find('td').each(function(){
            valores.push($(this).html());
        });
        alert(valores);
    } );
});