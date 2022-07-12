'use strict';
$(document).ready(function(){
    $('.insertPrecio').hide();
});

function detailList(obj, lista){
    let id = $(obj).parents('tr').find('#claveLista').text();
    let campo = `
        <input hidden type="number" name="clave_lista" id="clave_lista" value='${id}'>
                `;
    let data = $(obj).parents('tr').find('#nombreLista').text();

    $('#detailListLabel').empty();
    $('#claveListaNew').empty();

    $('#detailListLabel').append('Precios de estudios/perfiles: ' + data);
    $('#claveListaNew').append(campo);

    $('#detailList').modal('show');
    rellenaTabla(obj);

}

function showFila(obj){
    if($(obj).is(':checked')){
        $(obj).parents('tr').find('td').eq(4).show();
    }else{
        $(obj).parents('tr').find('td').eq(4).hide();
    }
}

function saveAnalitos(){
    let lista=[];

    var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
    let id = $('#clave_lista').val();

    // let dato = new Array();

    $('#listPreciosAnalitos tr').each(function(){
        let clave = $(this).find('.clave').html();
        let precio = $(this).find(".precioAnalito").val();
    //     let precio= $(this).parents('tr').find('.precioAnalito').val();
    
        lista.push({ 
                    clave: clave,
                    precio: precio,
                });
    }); 

    console.log(lista);

    axios.post('/catalogo/store-precio-estudios', {
        precio_id: id,
        data: lista,
        _token: CSRF_TOKEN,
    })
    .then(function (response) {
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
        title: 'Precios asignados correctamente'
        });
        //  Reload
        setTimeout(function(){
            window.location.reload();
        }, 2900);
    console.log(response);
    })
    .catch(function (error) {
    console.log(error);
    });
}

function rellenaTabla(obj){
    var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
    let id = $(obj).parents('tr').find('#claveLista').text();

    $('#listPreciosEstudios').DataTable({
        ajax: {
            url: 'get-estudios-asignados',
            type: 'POST',
            dataSrc: '',
            data: {
                data: id,
                _token: CSRF_TOKEN,
            }
        },
        columns: [
            {data: 'id'},
            {data: 'clave'},
            {data: 'descripcion'},
            {data: 'precio'},
            {data: null, render:function(data){
                return '<button class="btn btn-secondary"></button>';
            }},
        ],
        drawCallback: function (settings) {
            $('[data-toggle="tooltip"]').tooltip({ boundary: 'window' });
        },
        language:{ 
            url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        }
    });
    
}