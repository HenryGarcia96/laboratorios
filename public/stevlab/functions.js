function getStates(){
    $('#estado').empty();
    let estados;
    let pais = $('#pais').val();

    const respone = axios.post('/getStates',{
        pais: pais,
      })
      .then(res => {
        let dato = res.data;
        dato.forEach(function(index, value){
            // console.log(index);
            estados = `<option value="${index.state_name}">${index.state_name}</option>`;  
            $('#estado').append(estados);
        });
      })
      .catch((err) =>{
        console.log(err);
      });
}

function getCity(){
    $('#ciudad').empty();
    let ciudades;
    let ciudad = $('#estado').val();

    const respone = axios.post('/getCity',{
        ciudad: ciudad,
      })
      .then(res => {
        console.log(res);
        let dato = res.data;
        dato.forEach(function(index, value){
            // console.log(index);
            ciudades = `<option value="${index.city_name}">${index.city_name}</option>`;  
            $('#ciudad').append(ciudades);
        });
      })
      .catch((err) =>{
        console.log(err);
      });
}