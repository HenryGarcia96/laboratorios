'use strict';
$(document).ready(function(){
    $('.insertPrecio').hide();
});

function detailList(obj, lista){
    let data = $(obj).parents('tr').find('#nombreEstudio').text();
    $('#detailListLabel').append(data);
    $('#detailList').modal('show');
}

function showFila(obj){
    if($(obj).is(':checked')){
        $(obj).parents('tr').find('td').eq(4).show();
    }else{
        $(obj).parents('tr').find('td').eq(4).hide();
    }
}