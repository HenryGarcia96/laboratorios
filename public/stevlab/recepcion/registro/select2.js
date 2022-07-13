$(function() {
    'use strict';
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    
    var estudio = $('#listEstudio').select2({
        placeholder: 'Buscar estudios',
        ajax:{
            url: '../catalogo/getEstudios',
            type: 'get',
            delay: '200',
            data: function(params){
                return {
                    _token: CSRF_TOKEN,
                    q: params.term,
                }
            },
            processResults: function(data){
                var listEstudios = [];
                data.forEach(function(element, index){
                    let est_data = {id: element.id, text: `${element.clave} - ${element.codigo} - ${element.descripcion}`};
                    listEstudios.push(est_data);
                });
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: listEstudios
                };
            }
        }
        
    });
    $('#listEstudio').on('select2:select', function (e) {
        let data= e.params.data.id;
        // Revisame los analitos que ya esten asignados
        axios.post('../catalogo/checkEstudio', {
            _token: CSRF_TOKEN,
            data: data,
        })
        .then(function (response) {
            // Para settear los analitos
            let list =`<tr>
                                <th>${response.data.clave}</th>
                                <td>${response.data.descripcion}</td>
                                <td>Estudios</td>
                                <td>
                                    <span>
                                    ${response.data.precio}
                                    </span>
                                </td>
                                <td class='text-center'>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href=""><i data-feather="delete"></i></a>
                                </td>
                            </tr>`;
                $('#listEstudios').append(list);
                valuarTotal();
        })
        .catch(function (error) {
            console.log(error);
        });
    });
});