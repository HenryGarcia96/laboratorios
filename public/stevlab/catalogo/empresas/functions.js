'use strict';

function mostrarModal(obj){
	var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

    $('#modalEditar').modal('show');
    let data = $(obj).parent().parent().find('.data').html();

    const response = axios.post('/catalogo/getEmpresa', {
        _token: CSRF_TOKEN,
        data: data,
    })
    .then(res =>  {
        console.log(res.data);
        $('#id').val(res.data.id);
        $('#clave').val(res.data.clave);
        $('#descripcion').val(res.data.descripcion);
        $('#calle').val(res.data.calle);
        $('#colonia').val(res.data.colonia);
        $('#ciudad').val(res.data.ciudad);
        $('#telefono').val(res.data.telefono);
        $('#rfc').val(res.data.rfc);
        $('#email').val(res.data.email);
        $('#contacto').val(res.data.contacto);
        $('#list_precios').val(res.data.list_precios);
        $('#usuario').val(res.data.usuario);
        $('#password').val(res.data.password);



        // 
    }).catch((err) => {
        console.log(err);
    });
}