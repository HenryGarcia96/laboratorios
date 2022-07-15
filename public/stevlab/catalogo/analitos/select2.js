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
		let data= e.params.data.id;
		// Revisame los analitos que ya esten asignados
		axios.post('/catalogo/checkAnalitos', {
			_token: CSRF_TOKEN,
			data: data,
		})
		.then(function (response) {
			// Para settear los analitos
			response.data.forEach(function(element, index){
				let list =`
						<li class="list-group-item"> 
							<span></span> <strong>${element.clave}</strong> - ${element.descripcion}
							<button  onclick='removeAnalito(this)' type="button" class="text-white float-right btn btn-xs btn-warning btn-icon delete">
								<i class="mdi mdi-delete"></i>
							</button>
						</li>
					`;
				$('#analitos-list').append(list);
			});

		})
		.catch(function (error) {
			console.log(error);
		});

		// Para adjuntar el id del estudio
		let dato = `
				<input id='estudioId' type="hidden" value='${e.params.data.id}'>
			`;
		$('#estudioData').append(dato);
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
					let est_data = {id: element.id, text: `${element.clave} - ${element.descripcion} - tipo: ${element.tipo_resultado}`};
					
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
			let list =`
					<li class="list-group-item"> 
						<span></span> <strong>${res.data.clave}</strong> - ${res.data.descripcion}
						<button onclick='removeThis(this)' type="button" class=" float-right btn btn-xs btn-danger btn-icon delete">
							<i class="mdi mdi-delete"></i>
						</button>
					</li>
				`;
			$('#analitos-list').append(list);
		}).catch((err) => {
			console.log(err);
		});
	});
	
});
