'use strict';

function mostrarModal(obj){
	var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

    $('#modalEditar').modal('show');
    let data = $(obj).parent().parent().find('.data').html();

    const response = axios.post('/catalogo/getDoctor', {
        _token: CSRF_TOKEN,
        data: data,
    })
    .then(res =>  {
        console.log(res.data);
        $('#id').val(res.data.id);
        $('#clave').val(res.data.clave);
        $('#usuario').val(res.data.usuario);
        $('#password').val(res.data.password);
        $('#nombre').val(res.data.nombre);
        $('#ap_paterno').val(res.data.ap_paterno);
        $('#ap_materno').val(res.data.ap_materno);
        $('#telefono').val(res.data.telefono);
        $('#celular').val(res.data.celular);
        $('#email').val(res.data.email);
        // 
    }).catch((err) => {
        console.log(err);
    });
}

        // let table = `
        //         <tr>
        //             <td>
        //             ${res.data.clave}
        //             </td>

        //             <td>
        //             ${res.data.descripcion}
        //             </td>

        //             <td>
        //             ${res.data.tipo_resultado}
        //             </td>

        //             <td class='col-1'>
        //                 <input type="number" min='0'>
        //             </td>

        //             <td>
        //                 button
        //             </td>
        //         </tr>
        //     `;
        // $('#values').append(table);