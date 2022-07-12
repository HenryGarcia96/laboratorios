$(function() {
	'use strict'
	var CSRF_TOKEN = $('meta[name="_token"]').attr('content');
	
	var estudio = $('#searchEstudio').select2({
		dropdownParent: $('#detailList'),
		placeholder: 'Busca estudio',
		ajax: {
			url: 'getEstudios',
			type: 'get',
			delay: '200',
			data: function(params){
				return{
					// _token: CSRF_TOKEN,
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
	$('#searchEstudio').on('select2:select', function (e) {
		var data = e.params.data.id;

		const response = axios.post('set-estudios-for-precios', {
			data: data,
			_token: CSRF_TOKEN,
		})
		.then(res =>  {
			let list=`
					<tr>
						<th class='clave'>${res.data.clave}</th>
						<th>${res.data.descripcion}</th>
						<th>	
							<input type="number" min="0" class="form-control precioAnalito" placeholder="$0">
						</th>
					</tr>
				`;
			$('#listPreciosAnalitos').append(list);
			
		}).catch((err) => {
			console.log(err);
		});
	});
});