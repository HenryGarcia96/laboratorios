'use strict';
var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

// Mostrar campos para rellenar de acuerdo a lo que soliciten en analito
function displayValues(){
    
    $('#showReferencia').hide();
    $('#showEstado').hide();
    $('#showTipoValidacion').hide();
    $('#showNumerico').hide();
    $('#showDocumento').hide();
    
    let value = $('#tipo_resultado').val();
    
    if(value=='subtitulo'){
        $('#showReferencia').show();
    }else if(value=='texto'){
        $('#showReferencia').show();
        $('#showEstado').show();
        $('#showTipoValidacion').show();
    }else if(value=='numerico'){
        $('#showNumerico').show();
    }else if(value=='documento'){
        $('#showDocumento').show();
    }else{
        $('#showReferencia').hide();
        $('#showEstado').hide();
        $('#showTipoValidacion').hide();
        $('#showNumerico').hide();
        $('#showDocumento').hide();
    }
}

function removeAnalito(obj){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger me-2'
    },
    buttonsStyling: false,
    })
    
    swalWithBootstrapButtons.fire({
    title: '¿Estas seguro?',
    text: "Eliminarás el analito asignado actualmente. Está acción no se puede revertir!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonClass: 'me-2',
    confirmButtonText: 'Si, eliminar!',
    cancelButtonText: 'No, cancelar!',
    reverseButtons: true
    }).then((result) => {
    if (result.value) {
        var estudio = $('#estudioId').val();
        let data = $(obj).parent().text().split('-')[0].trim();
        // Elimina analito de analito
        const response = axios.post('/catalogo/eliminaAnalito',{
            _token: CSRF_TOKEN,
            estudio: estudio,
            data: data,
        })
        .then(res => {
            $(obj).parent().remove();
            console.log(res);
        })
        .catch((err) =>{
            console.log(err);
        });
        swalWithBootstrapButtons.fire(
        'Eliminado!',
        'Analito retirado del estudio',
        'success'
        );
    } else if (
        // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel
    ) {
        swalWithBootstrapButtons.fire(
        'Cancelado',
        'Analito no eliminado',
        'error'
        );
    }
    });
    

}

function removeThis(obj){
    $(obj).parent().remove();
}

function sendAnalitos(){
    var estudio = $('#estudioId').val();
    var data = [];
    var numero = 0;
    $('#analitos-list li').each(function(indice, elemento) {
        data[indice]= $(elemento).text().split('-')[0].trim();
        // .replace(/[$]/g,''))
    });
    
    console.log(data);
    console.log(estudio);

    const response = axios.post('/catalogo/asignAnalitos',{
        _token: CSRF_TOKEN,
        estudio: estudio,
        data: data,
    })
    .then(res => {
        
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
        title: 'Analitos asignados correctamente'
        })

        // Reload
        setTimeout(function(){
            window.location.reload();
        }, 3100);
    })
    .catch((err) =>{
        console.log(err);
    });
}

function removeReferences(obj, value){
    let dato = value;
    let analito = $('#analito').val();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger me-2'
    },
    buttonsStyling: false,
    })
    
    swalWithBootstrapButtons.fire({
    title: '¿Estas seguro?',
    text: "Eliminarás el valor de referencia asignado actualmente. Está acción no se puede revertir!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonClass: 'me-2',
    confirmButtonText: 'Si, eliminar!',
    cancelButtonText: 'No, cancelar!',
    reverseButtons: true
    }).then((result) => {
    if (result.value) {

        // Elimina referencia de analito
        $(obj).parent().parent().remove();
        const response = axios.post('/catalogo/eliminaReferencia',{
            _token: CSRF_TOKEN,
            referencia: dato,
            analito: analito
        })
        .then(res => {
            $(obj).parent().remove();
            console.log(res);
        })
        .catch((err) =>{
            console.log(err);
        });

        swalWithBootstrapButtons.fire(
        'Eliminado!',
        'Analito retirado del estudio',
        'success'
        );

    } else if (
        // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel
    ) {
        swalWithBootstrapButtons.fire(
        'Cancelado',
        'Referencia no eliminado',
        'error'
        );
    }
    });

}
function cerrarModal(){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger me-2'
    },
    buttonsStyling: false,
    })
    
    swalWithBootstrapButtons.fire({
    title: '¿Estas seguro?',
    text: "Terminar de asignar valores referenciales.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonClass: 'me-2',
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    reverseButtons: true
    }).then((result) => {
    if (result.value) {
        $('#modalReferencia').modal('hide');
        window.location.reload();
    } else if (
        // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel
    ) {
        swalWithBootstrapButtons.fire(
        'Cancelado',
        // '',
        'error'
        );
    }
    });
}