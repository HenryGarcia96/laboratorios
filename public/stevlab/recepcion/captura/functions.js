'use strict';
// Consulta tablas
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

// preparacion
$(function(){
    var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

    $('.datepicker').datepicker({
        startDate: '-2m',
        endDate: '0d',
    });

    var table = $('#dataTableMetodos').DataTable();

// Para abrir vista
    table.on( 'click', 'tr' ,function () {
        $('#appendComponente').empty();
        let folio = '';
        
        var valor = new FormData();
        $(this).find('td:eq(0)').each(function(){
            valor.append('folio',$(this).html());
            folio = $(this).html();
        });
        const response = axios.post('/recepcion/recover-estudios', valor ,{
        })
        .then(res => {
            // console.log(res);
            
            let dato = res.data;

            $('#modalEstudio').modal('show');

            dato.forEach(function(elemento, index){

                let analito = elemento.analitos;
                let id = elemento.id;

                let referencia = elemento.clave;

                let componente = `  <div class="row mb-3 asignEstudio">
                                        <input class='folioEstudio' type='hidden' value='${folio}'>
                                        <label class='form-label'><span class='claveEstudio'>${elemento.clave}</span> - ${elemento.descripcion}</label>
                                        
                                        <div class='col-md-12 asignAnalito${id}'>
                                        </div>
                                        <div class="mb-3">
                                            <button onclick='guardarEstudios(this)' type="submit" class="btn btn-outline-success guardar${elemento.clave}">Guardar</button>
                                            <button onclick='validarEstudios(this)' type="submit" class="btn btn-outline-info  validar${elemento.clave}" disabled>Validar</button>
                                            <button onclick='invalidarEstudios(this)' type="submit" class="btn btn-outline-secondary invalidar${elemento.clave}" disabled>Invalidar</button>
                                            <button onclick='generaPdf(this)' class='btn btn-outline-dark imprimir'>Imprimir</button>
                                        </div>
                                    </div>`;
                $('#appendComponente').append(componente);

                analito.forEach(function(analito, key){
                    let clave = analito.clave;
                    let tipo = analito.tipo_resultado;

                    if (tipo == 'subtitulo') {
                        // Numerico
                        let analitos = `<div class="row mb-3 listDato listDato${analito.clave}">
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
                                                    ${analito.defecto}
                                                </span>
                                            </div>
                                        </div>`;
                        // Añadir entrada
                        $('.asignAnalito'+ id).append(analitos);
                    } else if(tipo == 'texto'){
                        
                    } else if(tipo == 'numerico'){
                    // Numerico
                        let analitos = `<div class="row mb-3 listDato listDato${analito.clave}">
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

                    }else if(tipo == 'documento'){
                        // Numerico
                        let analitos = `<div class="row mb-3 listDato">
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
                                                    ${analito.defecto}
                                                </span>
                                            </div>
                                        </div>`;
                        // Añadir entrada
                        $('.asignAnalito'+ id).append(analitos);
                    }else if(tipo == 'referencia'){

                    }else if(tipo == 'imagen'){

                    }
                    
                    const respuesta = axios.post('/recepcion/verify-result', {
                        clave: clave,
                        folio: folio,
                    }).then(function(respon){
                        if(respon.data != ""){
                            console.log(respon);
                            $('.asignEstudio').find('.validar'+referencia).attr('disabled', false);
                        }
                        if(respon.data.estatus =='validado'){
                            $('.listDato'+clave).find('.storeDato').attr('disabled', true);
                            $('.asignEstudio').find('.validar'+referencia).attr('disabled', true);
                            $('.asignEstudio').find('.invalidar'+referencia).attr('disabled', false);
                        }
                        dato = respon.data.valor;
                        $('.listDato'+clave).find('.storeDato').val(dato);
                        // $('.storeDato').attr('disabled', true);
                        console.log(respon);
                    }).catch(function(err){
                        console.log(err);
                    });
                });

            });
        })
        .catch((err) =>{
            console.log(err);
        });

    });
});




function guardarEstudios(obj){
    let indice = 0;
    let estudio = [];
    let lista = [];

    $('.asignEstudio').each(function(){
        let index = 0;
        let key = $(this).find('.folioEstudio').val();
        
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
        title: 'Resultados guardados correctamente'
        });

        // Reload
        setTimeout(function(){
            window.location.reload();
        }, 1500);

        console.log(response);
    }).catch(function(error){
        console.log(error);
    });
}

function validarEstudios(){
    let indice = 0;
    let estudio = [];
    let lista = [];

    $('.asignEstudio').each(function(){
        let index = 0;
        let key = $(this).find('.folioEstudio').val();
        
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

    // Enviar para validar
    const validar = axios.post('/recepcion/validar-estudios', estudio, {
    }).then(function(respuesta){
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
        title: 'Resultados validados correctamente'
        });

        // Reload
        setTimeout(function(){
            window.location.reload();
        }, 1500);
    }).catch(function(error){
        console.log(error);
    });
}

function invalidarEstudios(){
    let indice = 0;
    let estudio = [];
    let lista = [];

    $('.asignEstudio').each(function(){
        let index = 0;
        let key = $(this).find('.folioEstudio').val();
        
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

    // Enviar para validar
    const validar = axios.post('/recepcion/invalidar-estudios', estudio, {
    }).then(function(respuesta){
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
        title: 'Resultados invalidados',
        });

        // Reload
        setTimeout(function(){
            window.location.reload();
        }, 1500);
    }).catch(function(error){
        console.log(error);
    });
}

function generaPdf(obj){
    let key='';
    $('.asignEstudio').each(function(){
        key = $(this).find('.folioEstudio').val();
    });

    const documento = axios.post('/recepcion/genera-documento-resultados',{
        clave: key,
    }).then(function(response){
        console.log(response);
        // window.open('http://laboratorios.test/' + ruta, 'Documento');
        window.open(response['data']['pdf']);
    }).catch(function(error){
        console.log(error);
    });
}