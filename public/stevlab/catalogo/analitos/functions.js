'use strict';

// Mostrar campos para rellenar de acuerdo a lo que soliciten en analito
function displayValues(){

    $('#showReferencia').hide();
    $('#showEstado').hide();
    $('#showTipoValidacion').hide();
    $('#showNumerico').hide();

    let value = $('#tipo_resultado').val();

    if(value=='subtitulo'){
        $('#showReferencia').show();
    }else if(value=='texto'){
        $('#showReferencia').show();
        $('#showEstado').show();
        $('#showTipoValidacion').show();
    }else if(value=='numerico'){
        $('#showNumerico').show();
    }else if(value='documento'){
        $('#showDocumento').show();
    }else{
        $('#showReferencia').hide();
        $('#showEstado').hide();
        $('#showTipoValidacion').hide();
        $('#showNumerico').hide();
        $('#showDocumento').hide();

    }

}