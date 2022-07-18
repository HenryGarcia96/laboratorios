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
                                        <label class='form-label'><span class='claveEstudio'>${elemento.clave}</span> - ${elemento.descripcion}</label>
                                        <div class='col-md-12 asignAnalito${id}'>
                                        </div>
                                        <div class="mb-3">
                                            <button onclick='guardarEstudios(this)' type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>`;
                $('#appendComponente').append(componente);

                analito.forEach(function(analito, key){
                    let tipo = analito.tipo_resultado;

                    // Valore referencial
                    let analitos = `<div class="row listDato">
                                        <input type='hidden' class='idAnalito${analito.clave}' id='${analito.clave}' value='${analito.clave}'>
                                        <div class='col-md-2 '>
                                            <span class='claveDato'>
                                                ${analito.clave}
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <span class='descripcionDato'>
                                                ${analito.descripcion}
                                            </span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" min='0' class="form-control storeDato">
                                        </div>
                                        <div class="col-md-2">
                                            <span class='ejemploDato'>
                                                ${analito.numero_uno} - ${analito.numero_dos}
                                            </span>
                                        </div>
                                    </div>`;
                        // Añadir entrada
                        $('.asignAnalito'+ id).append(analitos);

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
                        </tr>`;
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
    let indice = 0;
    let estudio = [];
    let lista = [];


    // let lista = new FormData();

    $('.asignEstudio').each(function(){
        let index = 0;
        let key = $(this).find('.claveEstudio').text();

        

        $('.listDato').each(function(){
            let clave = $(this).find('.claveDato').text();
            let descripcion = $(this).find('.descripcionDato').text();
            let valor = $(this).find('.storeDato').val();
            // let ejemplo = $(this).find('.ejemploDato').text();

            lista.push({
                clave: clave,
                descripcion: descripcion,
                valor: valor,
                // ejemplo: ejemplo,
            })
            
            index++;
        });

        estudio.push({
            codigo: key,
            lista: lista,
        });

        indice++

    });

    const response = axios.post('/recepcion/store-resultados-estudios', estudio ,{
    }).then(function(response){
        console.log(response);
    }).catch(function(error){
        console.log(error);
    });
}
