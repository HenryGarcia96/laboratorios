'use strict';


$(function() {
    // setInterval(valuarTotal, 3000);
});


function valuarTotal(){
    $('#num_total').empty();
    let precio = 0;

    $('#listEstudios tr').each(function(){
        precio = precio + parseFloat($(this).find('td:eq(2)').text());
        // console.log($(this).find('td:eq(2)').text());
    });
    $('#num_total').val('$' + precio + '.00');
    
}