'use strict';

function mostrarModal(obj){
	var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

    $('#modalEditar').modal('show'); 
    let data = $(obj).parent().parent().find('.data').html();

    const response = axios.post('/catalogo/getPaciente', {
        _token: CSRF_TOKEN,
        data: data, 
    })
    .then(res =>  {
        console.log(res.data);

        $('#id').val(res.data.id);
        $('#nombre').val(res.data.nombre);
        $('#ap_paterno').val(res.data.ap_paterno);
        $('#ap_materno').val(res.data.ap_materno);
        $('#domicilio').val(res.data.domicilio);
        $('#colonia').val(res.data.colonia);
        $('#sexo').val(res.data.sexo);
        $('#fecha_nacimiento').val(res.data.fecha_nacimiento);
        $('#celular').val(res.data.celular);
        $('#email').val(res.data.email);
        $('#id_empresa').val(res.data.empresa);
        $('#seguro_popular').val(res.data.seguro_popular);
        $('#vigencia_inicio').val(res.data.vigencia_inicio);
        $('#vigencia_fin').val(res.data.vigencia_fin);

        // 
    }).catch((err) => {
        console.log(err);
    });
   
}

