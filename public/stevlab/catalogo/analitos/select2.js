$(function() {
	'use strict'
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	

	var estudio = $('#selectEstudio').select2({
		placeholder: 'Busca estudio',
		ajax: {
			url: 'getEstudios',
			type: 'get',
			delay: '200',
			data: function(params){
				return{
					_token: CSRF_TOKEN,
					q: params.term,
				}
			},
			processResults: function (data) {
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
	$('#selectEstudio').on('select2:select', function (e) {
		$('#setAnalito').show();
	});
	
	
	var analito = $('#selectAnalito').select2({
		placeholder: 'Busca analito',
		ajax: {
			url: 'getAnalito',
			type: 'get',
			delay: '200',
			data: function(params){
				return{
					_token: CSRF_TOKEN,
					q: params.term,
				}
			},
			processResults: function (data) {
				var listEstudios = [];
				data.forEach(function(element, index){
					let est_data = {id: element.id, text: `${element.clave} - ${element.descripcion}`};
					
					listEstudios.push(est_data);
				});
				// Transforms the top-level key of the response object from 'items' to 'results'
				return {
					results: listEstudios
				};
			}
		}
	});
	$('#selectAnalito').on('select2:select', function (e) {
		var data = e.params.data.id;

		const response = axios.post('/setAnalito', {
			data: data,
		})
		.then(res =>  {
			console.log(res.data);
			let table = `
					<tr>
						<td>
						${res.data.clave}
						</td>

						<td>
						${res.data.descripcion}
						</td>

						<td>
						${res.data.tipo_resultado}
						</td>

						<td class='col-1'>
							<input type="number" min='0'>
						</td>

						<td>
							button
						</td>
					</tr>
				`;
			$('#values').append(table);
		}).catch((err) => {
			console.log(err);
		});
	});
	
});
