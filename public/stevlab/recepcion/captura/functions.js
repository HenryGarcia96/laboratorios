'use strict';

$(function(){

    $('.datepicker').datepicker({
        startDate: '-2m',
        endDate: '0d',
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


$('.consultaEstudios').change(function(){
    var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

    let fecha_inicio    = $('#selectInicio').val();
    let fecha_final     = $('#selectFinal').val();
    let sucursal        = $('#selectSucursal').val();
    let estado          = $('#selectEstudio').val();
    let area            = $('#selectArea').val();


    let data = new FormData();

    data.append('fecha_inicio', fecha_inicio);
    data.append('fecha_final', fecha_final);
    data.append('sucursal', sucursal);
    data.append('estado', estado);
    data.append('area', area);

    const response = axios.post('/recepcion/consulta-estudios', data ,{
    })
    .then(res => {
        console.log(res);
    })
    .catch((err) =>{
        console.log(err);
    });

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