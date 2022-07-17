'use strict';

$(function(){
    var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

    $('.datepicker').datepicker({
        startDate: '-2m',
        endDate: '0d',
    });

    // $('.js-example-basic-single').select2();
    var table = $('#dataTableMetodos').DataTable();


    table.on( 'click', 'tr' ,function () {
        $('#appendComponente').empty();

        var valor = new FormData();
        $(this).find('td:eq(0)').each(function(){
            valor.append('folio',$(this).html());
        });

        const response = axios.post('/recepcion/recover-estudios', valor ,{
        })
        .then(res => {
            // console.log(res);
            
            let dato = res.data;

            $('#modalEstudio').modal('show');

            dato.forEach(function(elemento, index){
                console.log(elemento);

                let analito = elemento.analitos;
                let id = elemento.id;

                let componente = `  <div class="row mb-3 asignEstudio">
                                        <label class='form-label'>${elemento.descripcion}</label>
                                        <div class='col-md-12 asignAnalito${id}'>
                                        </div>
                                        <div class="mb-3">
                                            <button onclick='guardarEstudios(this)' type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>`;
                $('#appendComponente').append(componente);

                analito.forEach(function(analito, key){
                    let tipo = analito.tipo_resultado;

                    if(tipo == 'subtitulo'){

                        // En caso de ser subtitulo
                        let analitos = `<div class="row">
                                            <input type='hidden' class='idAnalito${analito.clave}' id='idAnalito${analito.clave}' value='${analito.clave}'>
                                            <div class='col-md-2 claveAnalito'>
                                            ${analito.clave}
                                            </div>
                                            <div class="col-md-6">
                                                ${analito.descripcion}
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" min='0' class="form-control storeAnalito-${id}">
                                            </div>
                                        </div>`;
                        // Añadir entrada
                        $('.asignAnalito'+ id).append(analitos);

                    }else if(tipo == 'numerico'){

                        // En caso de ser valor referencial
                        let analitos = `<div class="row">
                                            <input type='hidden' class='idAnalito${analito.clave}' id='idAnalito${analito.clave}' value='${analito.clave}'>
                                            <div class='col-md-2 claveAnalito'>
                                            ${analito.clave}
                                            </div>
                                            <div class="col-md-6">
                                                ${analito.descripcion}
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" min='0' class="form-control storeAnalito-${id}">
                                            </div>
                                            <div class="col-md-2">${analito.numero_uno} - ${analito.numero_dos}
                                            </div>
                                        </div>`;
                        // Añadir entrada
                        $('.asignAnalito'+ id).append(analitos);

                    }else if(tipo == 'texto'){

                        // En caso de ser valor referencial
                        let analitos = `<div class="row">
                                            <input type='hidden' class='idAnalito${analito.clave}' id='idAnalito${analito.clave}' value='${analito.clave}'>
                                            <div class='col-md-2 claveAnalito'>
                                            ${analito.clave}
                                            </div>
                                            <div class="col-md-6">
                                                ${analito.descripcion}
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" min='0' class="form-control storeAnalito-${id}">
                                            </div>
                                        </div>`;
                        // Añadir entrada
                        $('.asignAnalito'+ id).append(analitos);

                    }else if(tipo == 'documento'){

                    }else if(tipo == 'imagen'){

                    }
                    
                });

            });
        })
        .catch((err) =>{
            console.log(err);
        });

    });
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
        $('#listEstudios').empty();

        let dato = res.data;
        dato.forEach(function(index, element){
            let datito = `
                        <tr>
                            <td>${index.folio}</td>
                            <td>${index.pacientes.nombre} ${index.pacientes.ap_paterno} ${index.pacientes.ap_materno}</td>
                            <td>Sucursal</td>
                            <td>${index.empresas.descripcion}</td>
                            <td>${moment(index.created_at).format('DD-MM-YYYY HH:mm:ss')}</td>
                        </tr>
            `;
            $('#listEstudios').append(datito);
        })

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


function guardarEstudios(obj){
    $(obj).find('.asignEstudio').each(function(){
        let datito = $(obj).html();
    });
    // let clave = $(obj).find().val();
    // let dato = $(obj).find().val();
    let data = new FormData();


}

// $(this).find('td:eq(0)').each(function(){
//     valor.append('folio',$(this).html());
// });